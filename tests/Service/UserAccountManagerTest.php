<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UserAccountManager;
use App\Tests\Support\EntityIdTrait;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

final class UserAccountManagerTest extends TestCase
{
    use EntityIdTrait;

    public function testBlockDeactivatesNonAdminUser(): void
    {
        $actor = $this->user(1, ['ROLE_ADMIN']);
        $target = $this->user(2);

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects(self::once())->method('persist')->with($target);
        $entityManager->expects(self::once())->method('flush');

        $manager = new UserAccountManager($entityManager, $this->userRepository());

        self::assertTrue($manager->block($actor, $target));
        self::assertFalse($target->isActive());
    }

    public function testCannotBlockSelfOrLastActiveAdmin(): void
    {
        $actor = $this->user(1, ['ROLE_ADMIN']);
        $lastAdmin = $this->user(2, ['ROLE_ADMIN']);

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects(self::never())->method('flush');

        $repository = $this->userRepository(activeAdmins: 1);
        $manager = new UserAccountManager($entityManager, $repository);

        self::assertFalse($manager->canBlock($actor, $actor));
        self::assertFalse($manager->canBlock($actor, $lastAdmin));
    }

    public function testApproveAndRejectVeterinaryRequestAdjustRoles(): void
    {
        $applicant = $this->user(3)->setIsVeteranApplicant(true);

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects(self::exactly(2))->method('persist')->with($applicant);
        $entityManager->expects(self::exactly(2))->method('flush');

        $manager = new UserAccountManager($entityManager, $this->userRepository());

        self::assertTrue($manager->approveVeterinaryRequest($applicant));
        self::assertTrue($applicant->isVeteranApproved());
        self::assertContains('ROLE_VETERINAIRE', $applicant->getRoles());

        self::assertTrue($manager->rejectVeterinaryRequest($applicant));
        self::assertFalse($applicant->isVeteranApplicant());
        self::assertFalse($applicant->isVeteranApproved());
        self::assertNotContains('ROLE_VETERINAIRE', $applicant->getRoles());
    }

    /**
     * @param list<string> $roles
     */
    private function user(int $id, array $roles = ['ROLE_USER']): User
    {
        $user = (new User())
            ->setEmail(sprintf('user%d@example.com', $id))
            ->setFirstName('User')
            ->setLastName((string) $id)
            ->setPassword('strong-password')
            ->setRoles($roles);

        self::setEntityId($user, $id);

        return $user;
    }

    private function userRepository(int $admins = 2, int $activeAdmins = 2): UserRepository
    {
        $repository = $this->createMock(UserRepository::class);
        $repository->method('countAdmins')->willReturn($admins);
        $repository->method('countActiveAdmins')->willReturn($activeAdmins);

        return $repository;
    }
}
