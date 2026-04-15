<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Repository\AdoptionRequestRepository;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/animal-shop/favorites', name: 'animal_shop_favorite_')]
final class AnimalShopFavoriteController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(Request $request, AnimalRepository $animalRepository, AdoptionRequestRepository $adoptionRequestRepository): Response
    {
        $favoriteIds = $request->getSession()->get('favorite_animals', []);
        $animals = $favoriteIds !== [] ? $animalRepository->findBy(['id' => $favoriteIds]) : [];
        $user = $this->getCurrentUser();

        return $this->render('favorite/index.html.twig', [
            'animals' => $animals,
            'favoriteIds' => $favoriteIds,
            'notificationCount' => $adoptionRequestRepository->countPendingForOwner((int) $user->getId()),
        ]);
    }

    #[Route('/{id}/remove', name: 'remove', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function remove(Request $request, int $id): JsonResponse
    {
        $session = $request->getSession();
        $favoriteIds = $session->get('favorite_animals', []);
        $favoriteIds = array_values(array_diff($favoriteIds, [$id]));
        $session->set('favorite_animals', $favoriteIds);

        return $this->json(['removed' => true, 'id' => $id]);
    }

    private function getCurrentUser(): User
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('You need to sign in to access favorites.');
        }

        return $user;
    }
}
