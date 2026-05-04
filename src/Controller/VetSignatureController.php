<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\VetSignatureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/vet/signature')]
final class VetSignatureController extends AbstractController
{
    public function __construct(
        private readonly VetSignatureService $vetSignatureService,
    ) {
    }

    #[Route('', name: 'vet_signature', methods: ['GET'])]
    public function prompt(Request $request): Response
    {
        $vet = $this->getVetUser();

        if (
            $request->hasSession()
            && $this->vetSignatureService->hasStoredSignature($vet)
            && $this->vetSignatureService->isVerified($request->getSession())
        ) {
            return $this->redirectToRoute('vet_dashboard');
        }

        return $this->render('security/signature.html.twig', [
            'requiresEnrollment' => !$this->vetSignatureService->hasStoredSignature($vet),
            'minimumPointCount' => $this->vetSignatureService->getMinimumInputPoints(),
        ]);
    }

    #[Route('/verify', name: 'vet_signature_verify', methods: ['POST'])]
    public function verify(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $vet = $this->getVetUser();

        if (!$request->hasSession()) {
            return $this->json(['message' => 'A login session is required to continue.'], Response::HTTP_BAD_REQUEST);
        }

        if (!$this->isCsrfTokenValid('vet_signature', (string) $request->headers->get('X-CSRF-TOKEN'))) {
            return $this->json(['message' => 'Security token expired. Please reload the page and try again.'], Response::HTTP_FORBIDDEN);
        }

        try {
            $payload = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return $this->json(['message' => 'Invalid signature payload.'], Response::HTTP_BAD_REQUEST);
        }

        if (!is_array($payload) || !isset($payload['points']) || !is_array($payload['points'])) {
            return $this->json(['message' => 'Signature points were not provided.'], Response::HTTP_BAD_REQUEST);
        }

        $points = $this->parseSignaturePoints($payload['points']);
        $session = $request->getSession();
        $isEnrollment = !$this->vetSignatureService->hasStoredSignature($vet);

        try {
            if ($isEnrollment) {
                $this->vetSignatureService->storeSignature($vet, $points);
                $entityManager->flush();
                $this->addFlash('success', 'Your login signature has been saved. Future vet logins will verify it automatically.');
            } else {
                $result = $this->vetSignatureService->verifySignature($vet, $points);
                if (!$result['matched']) {
                    return $this->json([
                        'message' => 'Signature mismatch. Please draw the signature registered to your veterinary account.',
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }

                $this->addFlash('success', 'Signature verified. Welcome back to the veterinary portal.');
            }
        } catch (\InvalidArgumentException $exception) {
            return $this->json(['message' => $exception->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\JsonException) {
            return $this->json(['message' => 'The signature could not be saved.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $this->vetSignatureService->markVerified($session);
        $redirect = $this->vetSignatureService->consumeTargetPath($session) ?? $this->generateUrl('vet_dashboard');

        return $this->json([
            'redirect' => $redirect,
            'mode' => $isEnrollment ? 'enroll' : 'verify',
        ]);
    }

    #[Route('/reset', name: 'vet_signature_reset', methods: ['POST'])]
    public function reset(Request $request, EntityManagerInterface $entityManager): RedirectResponse
    {
        $vet = $this->getVetUser();

        if (!$this->isCsrfTokenValid('vet_signature_reset', (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid signature reset token.');
        }

        $vet->setSignature(null);
        $entityManager->flush();

        if ($request->hasSession()) {
            $this->vetSignatureService->clearVerificationState($request->getSession());
        }

        $this->addFlash('success', 'Your veterinary login signature has been reset. Please create a new one to continue.');

        return $this->redirectToRoute('vet_signature');
    }

    private function getVetUser(): User
    {
        $user = $this->getUser();

        if (!$user instanceof User || !$this->vetSignatureService->requiresSignatureChallenge($user)) {
            throw $this->createAccessDeniedException('Access reserved for approved veterinary accounts.');
        }

        return $user;
    }

    /**
     * @param array<mixed, mixed> $rawPoints
     *
     * @return list<array{x: float|int|string, y: float|int|string}>
     */
    private function parseSignaturePoints(array $rawPoints): array
    {
        $points = [];

        foreach ($rawPoints as $rawPoint) {
            if (
                !is_array($rawPoint)
                || !array_key_exists('x', $rawPoint)
                || !array_key_exists('y', $rawPoint)
                || !(is_int($rawPoint['x']) || is_float($rawPoint['x']) || is_string($rawPoint['x']))
                || !(is_int($rawPoint['y']) || is_float($rawPoint['y']) || is_string($rawPoint['y']))
            ) {
                throw new \InvalidArgumentException('Signature points were not provided in the expected format.');
            }

            $points[] = [
                'x' => $rawPoint['x'],
                'y' => $rawPoint['y'],
            ];
        }

        return $points;
    }
}
