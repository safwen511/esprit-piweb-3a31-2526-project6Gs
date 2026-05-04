<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\AccountSupportAssistantService;
use App\Service\UserAccountManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/account-blocked')]
final class BlockedAccountSupportController extends AbstractController
{
    #[Route('', name: 'app_blocked_support', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $email = trim((string) $request->query->get('email', ''));

        return $this->render('security/blocked_support.html.twig', [
            'prefillEmail' => $email,
        ]);
    }

    #[Route('/ask', name: 'app_blocked_support_ask', methods: ['POST'])]
    public function ask(
        Request $request,
        AccountSupportAssistantService $assistantService,
    ): JsonResponse {
        if (!$this->isCsrfTokenValid('blocked_support_ask', (string) $request->headers->get('X-CSRF-TOKEN'))) {
            return new JsonResponse(['message' => 'Invalid support request token. Refresh the page and try again.'], Response::HTTP_FORBIDDEN);
        }

        $question = trim((string) $request->request->get('question', ''));
        $historyRaw = (string) $request->request->get('history', '[]');
        if ($question === '') {
            return new JsonResponse(['message' => 'Please describe your issue first.'], Response::HTTP_BAD_REQUEST);
        }

        $history = json_decode($historyRaw, true);
        if (!is_array($history)) {
            $history = [];
        }

        try {
            $answer = $assistantService->answerQuestion($question, (string) $request->getLocale(), $history);
        } catch (\InvalidArgumentException $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable) {
            return new JsonResponse([
                'resolved' => false,
                'answer' => 'Support assistant is temporarily unavailable. Please request admin intervention below.',
            ]);
        }

        return new JsonResponse($answer);
    }

    #[Route('/escalate', name: 'app_blocked_support_escalate', methods: ['POST'])]
    public function escalate(
        Request $request,
        UserRepository $userRepository,
        AccountSupportAssistantService $assistantService,
        UserAccountManager $userAccountManager,
        EntityManagerInterface $entityManager,
    ): JsonResponse {
        if (!$this->isCsrfTokenValid('blocked_support_escalate', (string) $request->request->get('_token'))) {
            return new JsonResponse(['message' => 'Invalid escalation token. Refresh the page and try again.'], Response::HTTP_FORBIDDEN);
        }

        $email = mb_strtolower(trim((string) $request->request->get('email', '')));
        $details = trim((string) $request->request->get('details', ''));
        $historyRaw = (string) $request->request->get('history', '[]');

        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return new JsonResponse(['message' => 'Enter a valid email address.'], Response::HTTP_BAD_REQUEST);
        }

        if ($details === '' || mb_strlen($details) < 8) {
            return new JsonResponse(['message' => 'Please add a few details so admins can help quickly.'], Response::HTTP_BAD_REQUEST);
        }

        $history = json_decode($historyRaw, true);
        if (!is_array($history)) {
            $history = [];
        }

        $blockedUser = $userRepository->findOneBy(['email' => $email]);

        if (!$blockedUser instanceof User) {
            return new JsonResponse([
                'message' => 'Intervention request submitted. If an account exists with this email, an admin will review it.',
            ]);
        }

        if ($blockedUser->isActive()) {
            return new JsonResponse([
                'message' => 'This account is currently active. Try signing in again or reset your password.',
            ]);
        }

        try {
            $appealDecision = $assistantService->evaluateUnblockAppeal($blockedUser, $details, (string) $request->getLocale(), $history);
        } catch (\InvalidArgumentException $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable) {
            $appealDecision = [
                'approved' => false,
                'confidence' => 0.0,
                'summary' => 'AI review unavailable; sent to admin review.',
                'user_message' => 'Your request was sent to an administrator for review.',
                'escalate' => true,
            ];
        }

        if ($appealDecision['approved']) {
            if ($userAccountManager->unblock($blockedUser, $blockedUser)) {
                $this->notifyAdmins(
                    $userRepository,
                    $entityManager,
                    $blockedUser,
                    $this->buildAutoUnblockMessage($blockedUser, $details, $appealDecision['summary'])
                );

                return new JsonResponse([
                    'message' => $appealDecision['user_message'],
                    'autoResolved' => true,
                    'decision' => $appealDecision,
                ]);
            }

            $fallbackMessage = $this->buildEscalationMessage($blockedUser, $details, 'Automatic unblock was approved but could not be applied; manual review needed.');
            $this->notifyAdmins($userRepository, $entityManager, $blockedUser, $fallbackMessage);

            return new JsonResponse([
                'message' => 'The account could not be reactivated automatically. Your request was sent to an administrator instead.',
                'autoResolved' => false,
                'decision' => $appealDecision,
            ]);
        }

        $message = $this->buildEscalationMessage($blockedUser, $details, $appealDecision['summary']);
        $this->notifyAdmins($userRepository, $entityManager, $blockedUser, $message);

        return new JsonResponse([
            'message' => $appealDecision['user_message'] !== ''
                ? $appealDecision['user_message']
                : 'Admin intervention requested. Please wait while an administrator reviews your account.',
            'autoResolved' => false,
            'decision' => $appealDecision,
        ]);
    }

    private function buildEscalationMessage(User $blockedUser, string $details, string $aiSummary = ''): string
    {
        $owner = trim($blockedUser->getFullName());
        $owner = $owner !== '' ? $owner : (string) $blockedUser->getEmail();
        $normalizedDetails = trim((string) preg_replace('/\s+/', ' ', $details));
        $summary = trim((string) preg_replace('/\s+/', ' ', $aiSummary));

        $payload = $summary !== ''
            ? sprintf('Blocked account review for %s | AI: %s | Appeal: %s', $owner, $summary, $normalizedDetails)
            : sprintf('Blocked account help request from %s: %s', $owner, $normalizedDetails);

        if (mb_strlen($payload) <= 255) {
            return $payload;
        }

        return rtrim(mb_substr($payload, 0, 252)).'...';
    }

    private function buildAutoUnblockMessage(User $blockedUser, string $details, string $aiSummary): string
    {
        $owner = trim($blockedUser->getFullName());
        $owner = $owner !== '' ? $owner : (string) $blockedUser->getEmail();
        $normalizedDetails = trim((string) preg_replace('/\s+/', ' ', $details));
        $summary = trim((string) preg_replace('/\s+/', ' ', $aiSummary));

        $payload = sprintf('AI auto-unblocked %s | AI: %s | Appeal: %s', $owner, $summary !== '' ? $summary : 'approved appeal', $normalizedDetails);

        if (mb_strlen($payload) <= 255) {
            return $payload;
        }

        return rtrim(mb_substr($payload, 0, 252)).'...';
    }

    private function notifyAdmins(
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        User $blockedUser,
        string $message,
    ): void {
        $adminUsers = $userRepository->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :adminRole')
            ->setParameter('adminRole', '%ROLE_ADMIN%')
            ->getQuery()
            ->getResult();

        foreach ($adminUsers as $adminUser) {
            if (!$adminUser instanceof User || $adminUser->getId() === null) {
                continue;
            }

            $notification = (new Notification())
                ->setRecipientId($adminUser->getId())
                ->setActorId((int) $blockedUser->getId())
                ->setType('support')
                ->setMessage($message)
                ->setIsRead(false)
                ->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($notification);
        }

        $entityManager->flush();
    }
}
