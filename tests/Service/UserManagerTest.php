<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\User;
use App\Service\UserManager;
use PHPUnit\Framework\TestCase;

class UserManagerTest extends TestCase
{
    public function testValidUser(): void
    {
        $user = (new User())
            ->setFirstName('Donni')
            ->setLastName('Scolaire')
            ->setEmail('donni@example.com')
            ->setPassword('strongpass123');

        $manager = new UserManager();

        self::assertTrue($manager->validate($user));
    }

    public function testUserWithoutFirstName(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le prenom est obligatoire');

        $user = (new User())
            ->setFirstName('   ')
            ->setLastName('Scolaire')
            ->setEmail('donni@example.com')
            ->setPassword('strongpass123');

        $manager = new UserManager();
        $manager->validate($user);
    }

    public function testUserWithInvalidEmail(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Email invalide');

        $user = (new User())
            ->setFirstName('Donni')
            ->setLastName('Scolaire')
            ->setEmail('email_invalide')
            ->setPassword('strongpass123');

        $manager = new UserManager();
        $manager->validate($user);
    }

    public function testUserWithShortPassword(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le mot de passe doit contenir au moins 8 caracteres');

        $user = (new User())
            ->setFirstName('Donni')
            ->setLastName('Scolaire')
            ->setEmail('donni@example.com')
            ->setPassword('short');

        $manager = new UserManager();
        $manager->validate($user);
    }
}
