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
    private const MIN_PHRASE_SIMILARITY = 0.72;
    private const MIN_PHRASE_WORD_OVERLAP = 0.5;
    private const PHRASE_ASSISTED_VOICE_SCORE = 0.38;
    private const EXACT_PHRASE_ASSISTED_VOICE_SCORE = 0.28;
    private const PHRASE_ASSISTED_MIN_DURATION_RATIO = 0.45;
    private const PHRASE_ASSISTED_MAX_DURATION_GAP_SECONDS = 5.0;

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
        $browserDetectedPhrase = $this->extractDetectedPhrase($request);

        if (!$file instanceof UploadedFile) {
            return new JsonResponse(['message' => 'Please record a voice sample first.'], Response::HTTP_BAD_REQUEST);
        }

        /** @var User $user */
        $user = $this->getUser();
        $previousSample = $user->getVoiceSamplePath();
        $relativePath = $voiceSampleUploader->upload($user, $file);
        $absolutePath = $voiceSampleUploader->resolveAbsolutePath($relativePath);

        try {
            $detection = $voiceService->detect($absolutePath);
        } catch (VoiceServiceException $exception) {
            $voiceSampleUploader->delete($relativePath);

            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable) {
            $voiceSampleUploader->delete($relativePath);

            return new JsonResponse(['message' => 'Voice enrollment could not be completed.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $detectedPhrase = $this->resolveDetectedPhrase(
            isset($detection['transcript']) && is_string($detection['transcript']) ? $detection['transcript'] : '',
            $browserDetectedPhrase,
        );

        $vector = [];
        $enrollmentMode = 'phrase_only';
        try {
            $vector = $voiceService->enroll($absolutePath);
            $enrollmentMode = 'phrase_and_voice';
        } catch (VoiceServiceException $exception) {
            if ($detectedPhrase === '') {
                $voiceSampleUploader->delete($relativePath);

                return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
            }

            $this->logger->warning('Voice enrollment fell back to phrase-only mode after vector extraction failed.', [
                'userId' => $user->getId(),
                'email' => $user->getEmail(),
                'reason' => $exception->getMessage(),
            ]);
        } catch (\Throwable) {
            if ($detectedPhrase === '') {
                $voiceSampleUploader->delete($relativePath);

                return new JsonResponse(['message' => 'Voice enrollment could not be completed.'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $this->logger->warning('Voice enrollment fell back to phrase-only mode after an unexpected vector extraction failure.', [
                'userId' => $user->getId(),
                'email' => $user->getEmail(),
            ]);
        }

        if ($previousSample && $previousSample !== $relativePath) {
            $voiceSampleUploader->delete($previousSample);
        }

        $enrolledAt = new \DateTimeImmutable();
        $user
            ->setVoiceSamplePath($relativePath)
            ->setVoiceVector($vector !== [] ? $vector : null)
            ->setVoicePassphrase($detectedPhrase !== '' ? $detectedPhrase : null)
            ->setVoiceEnrolledAt($enrolledAt);

        $this->entityManager->flush();

        $response = [
            'message' => $detectedPhrase !== ''
                ? 'Voice sign-in is ready. We saved the spoken words you just said.'
                : 'Voice recognition is ready on this account.',
            'enrolledAt' => $enrolledAt->format('Y-m-d H:i'),
            'debug' => [
                'speechSeconds' => (float) $detection['speechSeconds'],
                'sampleRate' => (int) $detection['sampleRate'],
                'speechDetector' => isset($detection['speechDetector']) && is_string($detection['speechDetector']) ? $detection['speechDetector'] : null,
                'transcriptionLanguage' => isset($detection['transcriptionLanguage']) && is_string($detection['transcriptionLanguage']) ? $detection['transcriptionLanguage'] : null,
                'transcriptionEngine' => isset($detection['transcriptionEngine']) && is_string($detection['transcriptionEngine']) ? $detection['transcriptionEngine'] : null,
                'enrollmentMode' => $enrollmentMode,
            ],
        ];

        if ($detectedPhrase !== '') {
            $response['detectedPhrase'] = $this->normalizeVoicePassphrase($detectedPhrase);
        }

        return new JsonResponse($response);
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
        $browserDetectedPhrase = $this->extractDetectedPhrase($request);
        $file = $request->files->get('file');

        if ($email === '') {
            return new JsonResponse(['message' => 'Enter your email first.'], Response::HTTP_BAD_REQUEST);
        }

        if (!$file instanceof UploadedFile) {
            return new JsonResponse(['message' => 'Please record a voice sample first.'], Response::HTTP_BAD_REQUEST);
        }

        $user = $userRepository->findOneBy(['email' => $email]);
        if (!$user instanceof User) {
            return new JsonResponse(['message' => 'No account found for that email.'], Response::HTTP_NOT_FOUND);
        }

        if (!$user->hasVoiceEnrollment()) {
            return new JsonResponse(['message' => 'This account does not have voice recognition set up yet.'], Response::HTTP_NOT_FOUND);
        }

        try {
            $detection = $voiceService->detect($file->getPathname());
        } catch (VoiceServiceException $exception) {
            $this->logger->warning('Voice login detection rejected by voice service.', [
                'email' => $email,
                'userId' => $user->getId(),
                'reason' => $exception->getMessage(),
            ]);

            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable) {
            $this->logger->error('Voice login detection failed unexpectedly.', [
                'email' => $email,
                'userId' => $user->getId(),
            ]);

            return new JsonResponse(['message' => 'Voice login could not be completed.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $detectedPhrase = $this->resolveDetectedPhrase(
            isset($detection['transcript']) && is_string($detection['transcript']) ? $detection['transcript'] : '',
            $browserDetectedPhrase,
        );

        $savedPassphrase = $user->getVoicePassphrase();
        $phraseMatch = null;
        if ($savedPassphrase !== null && trim($savedPassphrase) !== '' && $detectedPhrase !== '') {
            $phraseMatch = $this->compareVoicePassphrases($savedPassphrase, $detectedPhrase);
        }

        if ($this->canUsePhraseOnlyLogin($phraseMatch)) {
            $this->logger->info('Voice login accepted from spoken phrase match.', [
                'email' => $email,
                'userId' => $user->getId(),
                'detectedPhrase' => $detectedPhrase,
                'phraseMatch' => $phraseMatch,
            ]);

            return $this->completeVoiceLogin($user, $security, [
                'message' => 'Signed in because the spoken words matched your enrolled phrase.',
                'detectedPhrase' => $detectedPhrase !== '' ? $detectedPhrase : null,
                'usedPhraseOnly' => true,
                'usedPhraseAssist' => true,
                'phraseMetrics' => $phraseMatch,
            ]);
        }

        $referenceSamplePath = $user->getVoiceSamplePath();
        $storedVector = $user->getVoiceVector();
        if (($referenceSamplePath === null || $referenceSamplePath === '') || $storedVector === []) {
            return new JsonResponse([
                'message' => 'The spoken words did not match the enrolled phrase. Try again or use your password.',
                'detectedPhrase' => $detectedPhrase !== '' ? $detectedPhrase : null,
                'phraseMetrics' => $phraseMatch,
            ], Response::HTTP_UNAUTHORIZED);
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
            $result = $voiceService->verify($file->getPathname(), $storedVector, $absoluteReferenceSamplePath);
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

        $phraseAssistedMatch = $result['match'] !== true && $this->canUsePhraseAssistedMatch($result, $phraseMatch);

        if ($result['match'] !== true && !$phraseAssistedMatch) {
            $this->logger->info('Voice login denied after score comparison.', [
                'email' => $email,
                'userId' => $user->getId(),
                'score' => $result['score'],
                'metrics' => $result['metrics'] ?? null,
                'matched' => false,
                'phraseMatch' => $phraseMatch,
            ]);

            $responsePayload = [
                'message' => 'Voice not recognized. Try again or use your password.',
                'score' => $result['score'],
                'metrics' => $result['metrics'] ?? null,
                'detectedPhrase' => $detectedPhrase !== '' ? $detectedPhrase : null,
            ];

            if ($phraseMatch !== null) {
                $responsePayload['phraseMetrics'] = $phraseMatch;
            }

            return new JsonResponse($responsePayload, Response::HTTP_UNAUTHORIZED);
        }

        $this->logger->info('Voice login accepted after score comparison.', [
            'email' => $email,
            'userId' => $user->getId(),
            'score' => $result['score'],
            'metrics' => $result['metrics'] ?? null,
            'matched' => true,
            'phraseMatch' => $phraseMatch,
            'phraseAssisted' => $phraseAssistedMatch,
        ]);

        return $this->completeVoiceLogin($user, $security, [
            'message' => $phraseAssistedMatch
                ? 'Signed in with voice recognition after confirming both your voice and spoken phrase.'
                : 'Signed in with voice recognition.',
            'score' => $result['score'],
            'metrics' => $result['metrics'] ?? null,
            'detectedPhrase' => $detectedPhrase !== '' ? $detectedPhrase : null,
            'usedPhraseAssist' => $phraseAssistedMatch,
            'phraseMetrics' => $phraseMatch,
        ]);
    }

    private function extractDetectedPhrase(Request $request): string
    {
        foreach (['detected_phrase', 'passphrase', 'phrase'] as $field) {
            $value = trim((string) $request->request->get($field, ''));
            if ($value !== '') {
                return $value;
            }
        }

        return '';
    }

    private function normalizeVoicePassphrase(string $passphrase): string
    {
        $normalized = mb_strtolower(trim($passphrase));
        $normalized = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $normalized) ?? '';
        $normalized = preg_replace('/\s+/u', ' ', $normalized) ?? '';

        return trim($normalized);
    }

    private function resolveDetectedPhrase(string ...$candidates): string
    {
        foreach ($candidates as $candidate) {
            $normalized = $this->normalizeVoicePassphrase($candidate);
            if ($normalized !== '') {
                return $normalized;
            }
        }

        return '';
    }

    private function isStrongPhraseMatch(array $phraseMatch): bool
    {
        if (($phraseMatch['exactMatch'] ?? false) === true) {
            return true;
        }

        if (($phraseMatch['containsExpected'] ?? false) === true) {
            return true;
        }

        $similarity = (float) ($phraseMatch['similarity'] ?? 0.0);
        $wordOverlap = (float) ($phraseMatch['wordOverlap'] ?? 0.0);
        $expectedWordCoverage = (float) ($phraseMatch['expectedWordCoverage'] ?? 0.0);

        return ($similarity >= self::MIN_PHRASE_SIMILARITY && $wordOverlap >= self::MIN_PHRASE_WORD_OVERLAP)
            || ($similarity >= 0.55 && $expectedWordCoverage >= 1.0);
    }

    private function canUsePhraseOnlyLogin(?array $phraseMatch): bool
    {
        return $phraseMatch !== null && $this->isStrongPhraseMatch($phraseMatch);
    }

    private function canUsePhraseAssistedMatch(array $result, ?array $phraseMatch): bool
    {
        if ($phraseMatch === null || !$this->isStrongPhraseMatch($phraseMatch)) {
            return false;
        }

        $metrics = isset($result['metrics']) && is_array($result['metrics']) ? $result['metrics'] : [];
        $score = (float) ($metrics['referenceScore'] ?? $result['score'] ?? 0.0);
        $durationRatio = (float) ($metrics['durationRatio'] ?? 0.0);
        $durationGapSeconds = (float) ($metrics['durationGapSeconds'] ?? INF);
        $requiredScore = ($phraseMatch['exactMatch'] ?? false) === true
            ? self::EXACT_PHRASE_ASSISTED_VOICE_SCORE
            : self::PHRASE_ASSISTED_VOICE_SCORE;

        return $score >= $requiredScore
            && $durationRatio >= self::PHRASE_ASSISTED_MIN_DURATION_RATIO
            && $durationGapSeconds <= self::PHRASE_ASSISTED_MAX_DURATION_GAP_SECONDS;
    }

    /**
     * @return array{
     *     expected: string,
     *     detected: string,
     *     similarity: float,
     *     wordOverlap: float,
     *     expectedWordCoverage: float,
     *     detectedWordCoverage: float,
     *     exactMatch: bool,
     *     containsExpected: bool
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
        $expectedWordCoverage = count($expectedWords) > 0 ? count($sharedWords) / count($expectedWords) : 0.0;
        $detectedWordCoverage = count($detectedWords) > 0 ? count($sharedWords) / count($detectedWords) : 0.0;
        $exactMatch = $normalizedExpected !== '' && $normalizedExpected === $normalizedDetected;
        $containsExpected = $normalizedExpected !== ''
            && $normalizedDetected !== ''
            && (
                str_contains($normalizedDetected, $normalizedExpected)
                || str_contains($normalizedExpected, $normalizedDetected)
            );

        return [
            'expected' => $normalizedExpected,
            'detected' => $normalizedDetected,
            'similarity' => round($similarity, 4),
            'wordOverlap' => round($wordOverlap, 4),
            'expectedWordCoverage' => round($expectedWordCoverage, 4),
            'detectedWordCoverage' => round($detectedWordCoverage, 4),
            'exactMatch' => $exactMatch,
            'containsExpected' => $containsExpected,
        ];
    }

    private function completeVoiceLogin(User $user, Security $security, array $payload): JsonResponse
    {
        $user->touchVoiceLastUsedAt();
        $this->entityManager->flush();

        $response = $security->login($user, LoginFormAuthenticator::class, 'main');
        $redirectTo = $response instanceof Response && $response->headers->has('Location')
            ? (string) $response->headers->get('Location')
            : $this->generateUrl('app_home');

        $payload['redirectTo'] = $redirectTo;

        return new JsonResponse($payload);
    }
}
