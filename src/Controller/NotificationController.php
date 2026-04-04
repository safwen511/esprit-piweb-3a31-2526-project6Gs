<?php

namespace App\Controller;

use App\Repository\AdoptionRequestRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    private function buildLayoutContext(UserRepository $userRepository, Request $request, array $context = []): array
    {
        return array_merge([
            'users' => $userRepository->findAll(),
            'currentUserId' => $request->getSession()->get('current_user_id'),
        ], $context);
    }

    #[Route('/notifications', name: 'notifications_index')]
    public function index(Request $request, UserRepository $userRepository, AdoptionRequestRepository $adoptionRequestRepository): Response
    {
        $session = $request->getSession();
        $currentUserId = $session->get('current_user_id');

        if (!$currentUserId) {
            $this->addFlash('error', 'flash.select_user_notifications');

            return $this->redirectToRoute('animal_index_default');
        }

        $currentUser = $userRepository->find($currentUserId);
        if (!$currentUser) {
            throw $this->createNotFoundException('User not found.');
        }

        $notifications = $adoptionRequestRepository->findPendingForOwner((int) $currentUserId);
        $clientIds = array_values(array_unique(array_filter(array_map(
            static fn($notification) => $notification->getClientId(),
            $notifications
        ))));

        $clients = [];
        if ($clientIds !== []) {
            foreach ($userRepository->findBy(['id' => $clientIds]) as $client) {
                $clients[$client->getId()] = $client;
            }
        }

        return $this->render('notification/index.html.twig', $this->buildLayoutContext($userRepository, $request, [
            'notifications' => $notifications,
            'currentUser' => $currentUser,
            'clients' => $clients,
        ]));
    }

    #[Route('/notifications/{id}/approve', name: 'notifications_approve', methods: ['POST'])]
    public function approve(int $id, Request $request, AdoptionRequestRepository $adoptionRequestRepository, EntityManagerInterface $em): RedirectResponse
    {
        return $this->updateStatus($id, $request, $adoptionRequestRepository, $em, 'APPROVED', 'flash.request_approved');
    }

    #[Route('/notifications/{id}/decline', name: 'notifications_decline', methods: ['POST'])]
    public function decline(int $id, Request $request, AdoptionRequestRepository $adoptionRequestRepository, EntityManagerInterface $em): RedirectResponse
    {
        return $this->updateStatus($id, $request, $adoptionRequestRepository, $em, 'REJECTED', 'flash.request_declined');
    }

    private function updateStatus(
        int $id,
        Request $request,
        AdoptionRequestRepository $adoptionRequestRepository,
        EntityManagerInterface $em,
        string $status,
        string $flashMessage,
    ): RedirectResponse {
        $currentUserId = $request->getSession()->get('current_user_id');

        if (!$currentUserId) {
            $this->addFlash('error', 'flash.select_user_manage_notifications');

            return $this->redirectToRoute('animal_index_default');
        }

        $notification = $adoptionRequestRepository->findPendingOwnedRequest($id, (int) $currentUserId);
        if (!$notification) {
            throw $this->createNotFoundException('Pending adoption request not found.');
        }

        if (!$this->isCsrfTokenValid('notification-action-' . $notification->getId(), (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'flash.invalid_request_token');

            return $this->redirectToRoute('notifications_index');
        }

        $notification->setStatus($status);
        $em->flush();

        $this->addFlash('success', $flashMessage);

        return $this->redirectToRoute('notifications_index');
    }
}
