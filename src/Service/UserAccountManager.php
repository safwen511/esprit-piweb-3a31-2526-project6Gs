<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserAccountManager
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserRepository $userRepository,
    )
    {
    }

    public function canBlock(User $actor, User $user): bool
    {
        if ($this->isSameUser($actor, $user)) {
            return false;
        }

        if ($this->isAdmin($user)) {
            return false;
        }

        if ($this->isLastActiveAdmin($user)) {
            return false;
        }

        return true;
    }

    public function block(User $actor, User $user): bool
    {
        if (!$this->canBlock($actor, $user) || !$user->isActive()) {
            return false;
        }

        $user->setIsActive(false);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return true;
    }

    public function unblock(User $actor, User $user): bool
    {
        if ($this->isSameUser($actor, $user) && $user->isActive()) {
            return false;
        }

        if ($user->isActive()) {
            return false;
        }

        $user->setIsActive(true);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return true;
    }

    public function canDelete(User $actor, User $user): bool
    {
        if ($this->isSameUser($actor, $user)) {
            return false;
        }

        if ($this->isLastAdmin($user)) {
            return false;
        }

        return true;
    }

    public function approveVeterinaryRequest(User $user): bool
    {
        if (!$user->isVeteranApplicant() || $user->isVeteranApproved()) {
            return false;
        }

        $roles = $user->getRoles();
        $roles[] = 'ROLE_VETERINAIRE';

        $user
            ->setIsVeteranApplicant(true)
            ->setIsVeteranApproved(true)
            ->setRoles(array_values(array_unique($roles)));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return true;
    }

    public function rejectVeterinaryRequest(User $user): bool
    {
        if (!$user->isVeteranApplicant() && !$user->isVeteranApproved()) {
            return false;
        }

        $roles = array_values(array_filter(
            $user->getRoles(),
            static fn (string $role): bool => 'ROLE_VETERINAIRE' !== $role
        ));

        $user
            ->setIsVeteranApplicant(false)
            ->setIsVeteranApproved(false)
            ->setRoles($roles);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return true;
    }

    public function delete(User $actor, User $user): bool
    {
        if (!$this->canDelete($actor, $user)) {
            return false;
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return true;
    }

    private function isSameUser(User $actor, User $user): bool
    {
        return $actor->getId() !== null && $actor->getId() === $user->getId();
    }

    private function isAdmin(User $user): bool
    {
        return in_array('ROLE_ADMIN', $user->getRoles(), true);
    }

    private function isLastAdmin(User $user): bool
    {
        return $this->isAdmin($user) && $this->userRepository->countAdmins() <= 1;
    }

    private function isLastActiveAdmin(User $user): bool
    {
        return $this->isAdmin($user) && $user->isActive() && $this->userRepository->countActiveAdmins() <= 1;
    }
}
