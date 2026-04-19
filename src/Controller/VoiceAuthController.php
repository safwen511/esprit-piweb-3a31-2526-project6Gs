<?php

namespace App\Controller;

use App\Entity\User;
use App\Exception\VoiceServiceException;
use App\Repository\UserRepository;
use App\Security\LoginFormAuthenticator;
use App\Service\VoiceSampleUploader;
use App\Service\VoiceService;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/voice')]
class VoiceAuthController extends AbstractController
{
    private const MIN_PHRASE_SIMILARITY = 0.82;
    private const MIN_PHRASE_WORD_OVERLAP = 0.75;

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly LoggerInterface $logger,
    ) {
    }

    #[Route('/enroll', name: 'app_voice_enroll', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function enroll(Request $request, VoiceSampleUploader $voiceSampleUploader, VoiceService $voiceService): JsonResponse
    {
        $file = $request->files->get('file');
        $passphrase = trim((string) $request->request->get('passphrase', ''));

        if (!$file instanceof UploadedFile) {
            return new JsonResponse(['message' => 'Please record a voice sample first.'], Response::HTTP_BAD_REQUEST);
        }

        if ($this->normalizeVoicePassphrase($passphrase) === '') {
            return new JsonResponse(['message' => 'We could not detect a voice phrase. Please record again and speak clearly.'], Response::HTTP_BAD_REQUEST);
        }

        /** @var User $user */
        $user = $this->getUser();
        $previousSample = $user->getVoiceSamplePath();
        $relativePath = $voiceSampleUploader->upload($user, $file);
        $absolutePath = $voiceSampleUploader->resolveAbsolutePath($relativePath);

        try {
            $voiceService->detect($absolutePath);
            $vector = $voiceService->enroll($absolutePath);
        } catch (VoiceServiceException $exception) {
            $voiceSampleUploader->delete($relativePath);

            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable) {
            $voiceSampleUploader->delete($relativePath);

            return new JsonResponse(['message' => 'Voice enrollment could not be completed.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($previousSample && $previousSample !== $relativePath) {
            $voiceSampleUploader->delete($previousSample);
        }

        $enrolledAt = new \DateTimeImmutable();
        $user
            ->setVoiceSamplePath($relativePath)
            ->setVoiceVector($vector)
            ->setVoicePassphrase($passphrase)
            ->setVoiceEnrolledAt($enrolledAt);

        $this->entityManager->flush();

        return new JsonResponse([
            'message' => 'Voice recognition is ready on this account.',
            'enrolledAt' => $enrolledAt->format('Y-m-d H:i'),
        ]);
    }

    #[Route('/login', name: 'app_voice_login', methods: ['POST'])]
    public function login(
        Request $request,
        UserRepository $userRepository,
        VoiceService $voiceService,
        VoiceSampleUploader $voiceSampleUploader,
        Security $security,
    ): JsonResponse
    {
        $email = mb_strtolower(trim((string) $request->request->get('email', '')));
        $passphrase = trim((string) $request->request->get('passphrase', ''));
        $file = $request->files->get('file');

        if ($email === '') {
            return new JsonResponse(['message' => 'Enter your email first.'], Response::HTTP_BAD_REQUEST);
        }

        if (!$file instanceof UploadedFile) {
            return new JsonResponse(['message' => 'Please record a voice sample first.'], Response::HTTP_BAD_REQUEST);
        }

        if ($this->normalizeVoicePassphrase($passphrase) === '') {
            return new JsonResponse(['message' => 'We could not detect the phrase in your recording. Please try again.'], Response::HTTP_BAD_REQUEST);
        }

        $user = $userRepository->findOneBy(['email' => $email]);
        if (!$user instanceof User) {
            return new JsonResponse(['message' => 'No account found for that email.'], Response::HTTP_NOT_FOUND);
        }

        if (!$user->hasVoiceEnrollment()) {
            return new JsonResponse(['message' => 'This account does not have voice recognition set up yet.'], Response::HTTP_NOT_FOUND);
        }

        $savedPassphrase = $user->getVoicePassphrase();
        if ($savedPassphrase === null || trim($savedPassphrase) === '') {
            return new JsonResponse([
                'message' => 'Your saved voice phrase is missing. Please sign in with your password and enroll your voice again.',
            ], Response::HTTP_CONFLICT);
        }

        $phraseMatch = $this->compareVoicePassphrases($savedPassphrase, $passphrase);
        if (
            $phraseMatch['similarity'] < self::MIN_PHRASE_SIMILARITY
            || $phraseMatch['wordOverlap'] < self::MIN_PHRASE_WORD_OVERLAP
        ) {
            $this->logger->info('Voice login rejected because the detected phrase did not match the saved phrase.', [
                'email' => $email,
                'userId' => $user->getId(),
                'phraseMatch' => $phraseMatch,
            ]);

            return new JsonResponse([
                'message' => 'The detected phrase is too different from your saved voice phrase. Please repeat the same words you used during enrollment.',
                'phraseMetrics' => $phraseMatch,
            ], Response::HTTP_UNAUTHORIZED);
        }

        $referenceSamplePath = $user->getVoiceSamplePath();
        if ($referenceSamplePath === null || $referenceSamplePath === '') {
            return new JsonResponse(['message' => 'Voice recognition setup is incomplete for this account.'], Response::HTTP_CONFLICT);
        }

        $absoluteReferenceSamplePath = $voiceSampleUploader->resolveAbsolutePath($referenceSamplePath);
        if (!is_file($absoluteReferenceSamplePath)) {
            $this->logger->warning('Voice login rejected because the enrolled sample file is missing.', [
                'email' => $email,
                'userId' => $user->getId(),
                'referenceSamplePath' => $referenceSamplePath,
            ]);

            return new JsonResponse([
                'message' => 'Your saved voice sample is missing. Please sign in with your password and enroll your voice again.',
            ], Response::HTTP_CONFLICT);
        }

        try {
            $result = $voiceService->verify($file->getPathname(), $user->getVoiceVector(), $absoluteReferenceSamplePath);
        } catch (VoiceServiceException $exception) {
            $this->logger->warning('Voice login verification rejected by voice service.', [
                'email' => $email,
                'userId' => $user->getId(),
                'reason' => $exception->getMessage(),
            ]);

            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable) {
            $this->logger->error('Voice login verification failed unexpectedly.', [
                'email' => $email,
                'userId' => $user->getId(),
            ]);

            return new JsonResponse(['message' => 'Voice login could not be completed.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($result['match'] !== true) {
            $this->logger->info('Voice login denied after score comparison.', [
                'email' => $email,
                'userId' => $user->getId(),
                'score' => $result['score'],
                'metrics' => $result['metrics'] ?? null,
                'matched' => false,
            ]);

            return new JsonResponse([
                'message' => 'Voice not recognized. Try again or use your password.',
                'score' => $result['score'],
                'metrics' => $result['metrics'] ?? null,
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user->touchVoiceLastUsedAt();
        $this->entityManager->flush();

        $response = $security->login($user, LoginFormAuthenticator::class, 'main');
        $redirectTo = $response instanceof Response && $response->headers->has('Location')
            ? (string) $response->headers->get('Location')
            : $this->generateUrl('app_home');

        $this->logger->info('Voice login accepted after score comparison.', [
            'email' => $email,
            'userId' => $user->getId(),
            'score' => $result['score'],
            'metrics' => $result['metrics'] ?? null,
            'matched' => true,
        ]);

        return new JsonResponse([
            'message' => 'Signed in with voice recognition.',
            'redirectTo' => $redirectTo,
            'score' => $result['score'],
            'metrics' => $result['metrics'] ?? null,
            'phraseMetrics' => $phraseMatch,
        ]);
    }

    private function normalizeVoicePassphrase(string $passphrase): string
    {
        $normalized = mb_strtolower(trim($passphrase));
        $normalized = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $normalized) ?? '';
        $normalized = preg_replace('/\s+/u', ' ', $normalized) ?? '';

        return trim($normalized);
    }

    /**
     * @return array{
     *     expected: string,
     *     detected: string,
     *     similarity: float,
     *     wordOverlap: float
     * }
     */
    private function compareVoicePassphrases(string $expected, string $detected): array
    {
        $normalizedExpected = $this->normalizeVoicePassphrase($expected);
        $normalizedDetected = $this->normalizeVoicePassphrase($detected);

        $maxLength = max(mb_strlen($normalizedExpected), mb_strlen($normalizedDetected));
        $distance = levenshtein($normalizedExpected, $normalizedDetected);
        $similarity = $maxLength > 0 ? max(0.0, 1 - ($distance / $maxLength)) : 0.0;

        $expectedWords = $normalizedExpected !== '' ? array_values(array_unique(explode(' ', $normalizedExpected))) : [];
        $detectedWords = $normalizedDetected !== '' ? array_values(array_unique(explode(' ', $normalizedDetected))) : [];
        $sharedWords = array_values(array_intersect($expectedWords, $detectedWords));
        $wordBase = max(count($expectedWords), count($detectedWords), 1);
        $wordOverlap = count($sharedWords) / $wordBase;

        return [
            'expected' => $normalizedExpected,
            'detected' => $normalizedDetected,
            'similarity' => round($similarity, 4),
            'wordOverlap' => round($wordOverlap, 4),
        ];
    }
}
