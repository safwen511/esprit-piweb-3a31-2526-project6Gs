<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteController extends AbstractController
{
    private function buildLayoutContext(UserRepository $userRepository, Request $request, array $context = []): array
    {
        return array_merge([
            'users' => $userRepository->findAll(),
            'currentUserId' => $request->getSession()->get('current_user_id'),
        ], $context);
    }

    #[Route('/favorites', name: 'favorite_index')]
    public function index(Request $request, AnimalRepository $animalRepository, UserRepository $userRepository): Response
    {
        $favoriteIds = $request->getSession()->get('favorite_animals', []);
        $animals = [];

        if (!empty($favoriteIds)) {
            $animals = $animalRepository->findBy(['id' => $favoriteIds]);
        }

        return $this->render('favorite/index.html.twig', $this->buildLayoutContext($userRepository, $request, [
            'animals' => $animals,
            'favoriteIds' => $favoriteIds,
        ]));
    }

    #[Route('/favorites/remove/{id}', name: 'favorite_remove', methods: ['POST'])]
    public function remove(Request $request, int $id): JsonResponse
    {
        $session = $request->getSession();
        $favoriteIds = $session->get('favorite_animals', []);
        $favoriteIds = array_values(array_diff($favoriteIds, [$id]));
        $session->set('favorite_animals', $favoriteIds);

        return $this->json([ 'removed' => true, 'id' => $id ]);
    }
}
