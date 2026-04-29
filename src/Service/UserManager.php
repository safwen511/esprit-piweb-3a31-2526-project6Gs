<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;

class UserManager
{
    public function validate(User $user): bool
    {
        if (trim($user->getFirstName()) === '') {
            throw new \InvalidArgumentException('Le prenom est obligatoire');
        }

        if (filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Email invalide');
        }

        if (mb_strlen($user->getPassword()) < 8) {
            throw new \InvalidArgumentException('Le mot de passe doit contenir au moins 8 caracteres');
        }

        return true;
    }
}
