<?php

namespace App\Controller;

use App\Entity\FaceCredential;
use App\Entity\User;
use App\Repository\FaceCredentialRepository;
use App\Repository\UserRepository;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/face')]
class FaceAuthController extends AbstractController
{
    private const MATCH_THRESHOLD = 0.5;

    public function __construct(
        private readonly FaceCredentialRepository $faceCredentialRepository,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/enroll', name: 'app_face_enroll', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function enroll(Request $request): JsonResponse
    {
        $data = json_decode((string) $request->getContent(), true);
        $descriptor = $this->normalizeDescriptor(is_array($data) ? ($data['descriptor'] ?? null) : null);

        if ($descriptor === null) {
            return new JsonResponse(['message' => 'Invalid face descriptor received.'], Response::HTTP_BAD_REQUEST);
        }

        /** @var User $user */
        $user = $this->getUser();

        foreach ($this->faceCredentialRepository->findForUser($user) as $existing) {
            $this->entityManager->remove($existing);
        }

        $credential = new FaceCredential();
        $credential->setUser($user)->setDescriptor($descriptor)->setLabel('Face Recognition');

        $this->entityManager->persist($credential);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Face recognition is ready on this account.']);
    }

    #[Route('/login', name: 'app_face_login', methods: ['POST'])]
    public function login(Request $request, UserRepository $userRepository, Security $security): JsonResponse
    {
        $data = json_decode((string) $request->getContent(), true);
        $data = is_array($data) ? $data : [];
        $email = mb_strtolower(trim((string) ($data['email'] ?? '')));
        $descriptor = $this->normalizeDescriptor($data['descriptor'] ?? null);

        if ($email === '') {
            return new JsonResponse(['message' => 'Enter your email first.'], Response::HTTP_BAD_REQUEST);
        }

        if ($descriptor === null) {
            return new JsonResponse(['message' => 'No face detected. Please try again.'], Response::HTTP_BAD_REQUEST);
        }

        $user = $userRepository->findOneBy(['email' => $email]);
        if (!$user instanceof User) {
            return new JsonResponse(['message' => 'No account found for that email.'], Response::HTTP_NOT_FOUND);
        }

        $credentials = $this->faceCredentialRepository->findForUser($user);
        if ($credentials === []) {
            return new JsonResponse(['message' => 'This account does not have face recognition set up yet.'], Response::HTTP_NOT_FOUND);
        }

        $bestDistance = PHP_FLOAT_MAX;
        $bestCredential = null;

        foreach ($credentials as $credential) {
            $distance = $this->euclideanDistance($descriptor, $credential->getDescriptor());
            if ($distance < $bestDistance) {
                $bestDistance = $distance;
                $bestCredential = $credential;
            }
        }

        if ($bestDistance > self::MATCH_THRESHOLD || $bestCredential === null) {
            return new JsonResponse(['message' => 'Face not recognized. Try again or use your password.'], Response::HTTP_UNAUTHORIZED);
        }

        $bestCredential->touchLastUsedAt();
        $this->entityManager->flush();

        $response = $security->login($user, LoginFormAuthenticator::class, 'main');
        $redirectTo = $response instanceof Response && $response->headers->has('Location')
            ? (string) $response->headers->get('Location')
            : $this->generateUrl('app_home');

        return new JsonResponse(['message' => 'Signed in with face recognition.', 'redirectTo' => $redirectTo]);
    }

    /**
     * @return list<float>|null
     */
    private function normalizeDescriptor(mixed $descriptor): ?array
    {
        if (!is_array($descriptor) || count($descriptor) !== 128) {
            return null;
        }

        $normalized = [];
        foreach ($descriptor as $value) {
            if (!is_numeric($value)) {
                return null;
            }

            $normalized[] = (float) $value;
        }

        return $normalized;
    }

    /**
     * @param list<float> $a
     * @param list<float> $b
     */
    private function euclideanDistance(array $a, array $b): float
    {
        $sum = 0.0;
        foreach ($a as $i => $v) {
            $diff = (float) $v - (float) ($b[$i] ?? 0.0);
            $sum += $diff * $diff;
        }

        return sqrt($sum);
    }
}
