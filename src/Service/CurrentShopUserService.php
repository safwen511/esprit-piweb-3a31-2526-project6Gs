<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class CurrentShopUserService
{
    private const SESSION_KEY = 'shop.current_user_id';

    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly UserRepository $users,
    ) {
    }

    public function getCurrentUser(Request $request): User
    {
        $session = $request->hasSession() ? $request->getSession() : $this->requestStack->getSession();
        $requestedUserId = $request->query->getInt('user_id', 0);

        if ($requestedUserId > 0) {
            $user = $this->users->find($requestedUserId);
            if ($user instanceof User) {
                $session?->set(self::SESSION_KEY, $requestedUserId);

                return $user;
            }
        }

        $sessionUserId = (int) ($session?->get(self::SESSION_KEY, 0) ?? 0);
        if ($sessionUserId > 0) {
            $user = $this->users->find($sessionUserId);
            if ($user instanceof User) {
                return $user;
            }
        }

        $defaultUser = $this->users->findDefaultUser();
        if (!$defaultUser instanceof User) {
            throw new \RuntimeException('No user found in the database.');
        }

        $session?->set(self::SESSION_KEY, $defaultUser->getId());

        return $defaultUser;
    }
}
