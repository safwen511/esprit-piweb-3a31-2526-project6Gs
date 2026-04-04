<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/app/current-user', name: 'app_get_current_user')]
    public function getCurrentUser(Request $request, UserRepository $userRepository): JsonResponse
    {
        $session = $request->getSession();
        $userId = $session->get('current_user_id');

        if (!$userId) {
            return $this->json(['userId' => null, 'username' => 'No user']);
        }

        $user = $userRepository->find($userId);
        
        return $this->json([
            'userId' => $user?->getId(),
            'username' => $user?->getUsername() ?? 'Unknown',
        ]);
    }

    #[Route('/app/users-list', name: 'app_users_list')]
    public function getUsersList(UserRepository $userRepository): JsonResponse
    {
        $users = $userRepository->findAll();
        
        $data = array_map(fn($user) => [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
        ], $users);

        return $this->json($data);
    }

    #[Route('/app/locale/{locale}', name: 'app_switch_locale', requirements: ['locale' => 'en|fr'])]
    public function switchLocale(string $locale, Request $request): RedirectResponse
    {
        $request->getSession()->set('_locale', $locale);

        $referer = $request->headers->get('referer');
        if ($referer) {
            return $this->redirect($referer);
        }

        return $this->redirectToRoute('animal_index_default');
    }
}
