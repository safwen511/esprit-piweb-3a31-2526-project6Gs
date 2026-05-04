<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Entity\User;
use App\Repository\NotificationRepository;
use App\Repository\UserRepository;
use App\Service\UserAccountManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin/support', name: 'admin_support_')]
final class AdminSupportController extends AbstractController
{
    #[Route('/blocked-accounts', name: 'blocked_accounts', methods: ['GET'])]
    public function index(NotificationRepository $notificationRepository, UserRepository $userRepository): Response
    {
        $supportRequests = $notificationRepository->findRecentSupportRequests();
        $actorIds = array_values(array_unique(array_filter(array_map(
            static fn (Notification $notification): int => $notification->getActorId(),
            $supportRequests
        ))));

        $actors = [];
        if ($actorIds !== []) {
            $actorUsers = $userRepository->createQueryBuilder('u')
                ->andWhere('u.id IN (:ids)')
                ->setParameter('ids', $actorIds)
                ->getQuery()
                ->getResult();

            foreach ($actorUsers as $actorUser) {
                if ($actorUser instanceof User && $actorUser->getId() !== null) {
                    $actors[$actorUser->getId()] = $actorUser;
                }
            }
        }

        return $this->render('admin/support_blocked_accounts.html.twig', [
            'supportRequests' => $supportRequests,
            'actors' => $actors,
        ]);
    }

    #[Route('/blocked-accounts/{id}/resolve', name: 'resolve', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function resolve(
        Notification $notification,
        Request $request,
        UserRepository $userRepository,
        UserAccountManager $userAccountManager,
        EntityManagerInterface $entityManager,
    ): RedirectResponse {
        if (!$this->isCsrfTokenValid('admin_support_resolve_'.$notification->getId(), (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid CSRF token.');
        }

        if ($notification->getType() !== 'support') {
            throw $this->createNotFoundException('Support request not found.');
        }

        $notification->setIsRead(true);

        $targetUser = null;
        $actorId = $notification->getActorId();
        $actor = $userRepository->find($actorId);
        if ($actor instanceof User) {
            $targetUser = $actor;
        }

        if ($targetUser instanceof User && !$targetUser->isActive()) {
            $admin = $this->getUser();
            if ($admin instanceof User) {
                $userAccountManager->unblock($admin, $targetUser);
            }
        }

        $entityManager->flush();
        $this->addFlash('success', 'Support request marked as reviewed. Account was reactivated when possible.');

        return $this->redirectToRoute('admin_support_blocked_accounts');
    }
}
