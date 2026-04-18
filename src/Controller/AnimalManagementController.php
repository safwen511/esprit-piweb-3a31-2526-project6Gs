<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Repository\AdoptionRequestRepository;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class AnimalManagementController extends AbstractController
{
    #[Route('/dashboard/animals', name: 'app_animal_management', methods: ['GET'])]
    public function index(
        Request $request,
        AnimalRepository $animalRepository,
        AdoptionRequestRepository $adoptionRequestRepository,
    ): Response {
        $user = $this->getCurrentUser();
        $favoriteIds = $request->getSession()->get('favorite_animals', []);

        return $this->render('animal/management.html.twig', [
            'currentUser' => $user,
            'myAnimalsCount' => count($animalRepository->findByOwner($user)),
            'myRequestsCount' => count($adoptionRequestRepository->findForClient((int) $user->getId())),
            'notificationCount' => $adoptionRequestRepository->countPendingForOwner((int) $user->getId()),
            'favoritesCount' => count($favoriteIds),
        ]);
    }

    private function getCurrentUser(): User
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('You need to sign in to access animal management.');
        }

        return $user;
    }
}
