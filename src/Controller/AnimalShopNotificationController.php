<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Repository\AdoptionRequestRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
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
    public function index(
        UserRepository $userRepository,
        AdoptionRequestRepository $adoptionRequestRepository,
        Request $request,
        PaginatorInterface $paginator,
    ): Response
    {
        $currentUser = $this->getCurrentUser();
        $notifications = $adoptionRequestRepository->findPendingForOwner((int) $currentUser->getId());
        $paginatedNotifications = $paginator->paginate(
            $notifications,
            $request->query->getInt('page', 1),
            10
        );
        $currentPageNotifications = is_array($paginatedNotifications->getItems())
            ? $paginatedNotifications->getItems()
            : iterator_to_array($paginatedNotifications->getItems(), false);
        $clientIds = array_values(array_unique(array_filter(array_map(
            static fn ($notification) => $notification->getClientId(),
            $currentPageNotifications
        ))));

        $clients = [];
        if ($clientIds !== []) {
            foreach ($userRepository->findBy(['id' => $clientIds]) as $client) {
                $clients[(int) $client->getId()] = $client;
            }
        }

        return $this->render('notification/index.html.twig', [
            'notifications' => $paginatedNotifications,
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

        if ($status === 'APPROVED') {
            $animal = $notification->getAnimal();
            $animalStatus = mb_strtolower(trim($animal->getStatus()));
            if ($animalStatus === 'adopted') {
                $this->addFlash('warning', 'This animal is already adopted.');

                return $this->redirectToRoute('animal_shop_notifications_index');
            }

            $animal->setStatus('ADOPTED');

            if ($animal->getId() !== null && $notification->getId() !== null) {
                $adoptionRequestRepository->rejectOtherPendingForAnimal((int) $animal->getId(), (int) $notification->getId());
            }
        }

        $entityManager->flush();
        $this->addFlash('success', $flashMessage);

        return $this->redirectToRoute('animal_shop_notifications_index');
    }
}
