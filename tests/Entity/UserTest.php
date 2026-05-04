<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    public function testEmailIsNormalizedAndRoleUserIsAlwaysPresent(): void
    {
        $user = (new User())
            ->setEmail('  DONNI@EXAMPLE.COM ')
            ->setRoles(['ROLE_ADMIN']);

        self::assertSame('donni@example.com', $user->getEmail());
        self::assertContains('ROLE_ADMIN', $user->getRoles());
        self::assertContains('ROLE_USER', $user->getRoles());
    }

    public function testVeterinaryApprovalAddsVeterinaireRole(): void
    {
        $user = (new User())->setIsVeteranApproved(true);

        self::assertContains('ROLE_VETERINAIRE', $user->getRoles());
        self::assertSame('Approved', $user->getVeterinaryRequestStatusLabel());
    }

    public function testProfileImagePathRejectsWindowsAbsolutePath(): void
    {
        $user = (new User())->setProfileImageUrl('C:\\Users\\Donni\\photo.jpg');

        self::assertNull($user->getProfileImagePath());
    }
}
