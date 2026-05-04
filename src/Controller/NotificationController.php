<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/social/notifications', name: 'social_notification_')]
final class NotificationController extends AbstractSocialController
{
    #[Route('/{id}/read', name: 'read', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function read(
        Notification $notification,
        Request $request,
        EntityManagerInterface $entityManager,
        Security $security,
    ): RedirectResponse {
        $currentUser = $this->requireCurrentSocialUser($security);

        if (!$this->isCsrfTokenValid('read_notification_'.$notification->getId(), (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid notification action.');

            return $this->redirectToRoute('feed_index');
        }

        if ($notification->getRecipientId() !== $currentUser->getId()) {
            throw $this->createAccessDeniedException('You cannot modify this notification.');
        }

        $notification->setIsRead(true);
        $entityManager->flush();

        return $this->redirectToRoute('feed_index');
    }

    #[Route('/read-all', name: 'read_all', methods: ['POST'])]
    public function readAll(
        Request $request,
        EntityManagerInterface $entityManager,
        Security $security,
    ): RedirectResponse {
        $currentUser = $this->requireCurrentSocialUser($security);

        if (!$this->isCsrfTokenValid('read_all_notifications', (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid notification action.');

            return $this->redirectToRoute('feed_index');
        }

        $notifications = $entityManager->getRepository(Notification::class)->findBy([
            'recipientId' => $currentUser->getId(),
            'isRead' => false,
        ]);

        foreach ($notifications as $notification) {
            if ($notification instanceof Notification) {
                $notification->setIsRead(true);
            }
        }

        $entityManager->flush();

        return $this->redirectToRoute('feed_index');
    }
}
