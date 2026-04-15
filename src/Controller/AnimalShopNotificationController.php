<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Repository\AdoptionRequestRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/animal-shop/notifications', name: 'animal_shop_notifications_')]
final class AnimalShopNotificationController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(UserRepository $userRepository, AdoptionRequestRepository $adoptionRequestRepository): Response
    {
        $currentUser = $this->getCurrentUser();
        $notifications = $adoptionRequestRepository->findPendingForOwner((int) $currentUser->getId());
        $clientIds = array_values(array_unique(array_filter(array_map(
            static fn ($notification) => $notification->getClientId(),
            $notifications
        ))));

        $clients = [];
        if ($clientIds !== []) {
            foreach ($userRepository->findBy(['id' => $clientIds]) as $client) {
                $clients[(int) $client->getId()] = $client;
            }
        }

        return $this->render('notification/index.html.twig', [
            'notifications' => $notifications,
            'currentUser' => $currentUser,
            'clients' => $clients,
            'notificationCount' => $adoptionRequestRepository->countPendingForOwner((int) $currentUser->getId()),
        ]);
    }

    #[Route('/{id}/approve', name: 'approve', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function approve(int $id, Request $request, AdoptionRequestRepository $adoptionRequestRepository, EntityManagerInterface $entityManager): RedirectResponse
    {
        return $this->updateStatus($id, $request, $adoptionRequestRepository, $entityManager, 'APPROVED', 'pet_home.flash.request_approved');
    }

    #[Route('/{id}/decline', name: 'decline', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function decline(int $id, Request $request, AdoptionRequestRepository $adoptionRequestRepository, EntityManagerInterface $entityManager): RedirectResponse
    {
        return $this->updateStatus($id, $request, $adoptionRequestRepository, $entityManager, 'REJECTED', 'pet_home.flash.request_declined');
    }

    private function getCurrentUser(): User
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('You need to sign in to access notifications.');
        }

        return $user;
    }

    private function updateStatus(
        int $id,
        Request $request,
        AdoptionRequestRepository $adoptionRequestRepository,
        EntityManagerInterface $entityManager,
        string $status,
        string $flashMessage,
    ): RedirectResponse {
        $currentUser = $this->getCurrentUser();
        $notification = $adoptionRequestRepository->findPendingOwnedRequest($id, (int) $currentUser->getId());

        if ($notification === null) {
            throw $this->createNotFoundException('Pending adoption request not found.');
        }

        if (!$this->isCsrfTokenValid('notification-action-'.$notification->getId(), (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'pet_home.flash.invalid_token');

            return $this->redirectToRoute('animal_shop_notifications_index');
        }

        $notification->setStatus($status);
        $entityManager->flush();
        $this->addFlash('success', $flashMessage);

        return $this->redirectToRoute('animal_shop_notifications_index');
    }
}
