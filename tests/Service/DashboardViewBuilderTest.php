<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\DashboardViewBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class DashboardViewBuilderTest extends TestCase
{
    public function testNonAdminDashboardUsesNavigationUrlsWithoutLoadingAdminStats(): void
    {
        $repository = $this->createMock(UserRepository::class);
        $repository->expects(self::never())->method('getDashboardStats');

        $view = (new DashboardViewBuilder($repository, $this->urlGenerator(), new ArrayAdapter()))
            ->build(new User(), false);

        self::assertFalse($view['isAdmin']);
        self::assertNull($view['stats']);
        self::assertNull($view['adminUsersUrl']);
        self::assertSame('/app_shop_management', $view['productManagementUrl']);
    }

    public function testAdminDashboardLoadsStatsApplicantsAndRecentUsers(): void
    {
        $pendingVet = (new User())->setEmail('vet@example.com');
        $recentUser = (new User())->setEmail('recent@example.com');

        $repository = $this->createMock(UserRepository::class);
        $repository->expects(self::once())->method('getDashboardStats')->willReturn(['totalUsers' => 2]);
        $repository->expects(self::once())->method('findPendingVeteranApplicants')->willReturn([$pendingVet]);
        $repository->expects(self::once())->method('findRecent')->willReturn([$recentUser]);

        $view = (new DashboardViewBuilder($repository, $this->urlGenerator(), new ArrayAdapter()))
            ->build(new User(), true);

        self::assertTrue($view['isAdmin']);
        self::assertSame(['totalUsers' => 2], $view['stats']);
        self::assertSame([$pendingVet], $view['pendingVeteranApplicants']);
        self::assertSame([$recentUser], $view['recentUsers']);
        self::assertSame('/admin_user_index', $view['adminUsersUrl']);
        self::assertSame('/app_user_directory', $view['userDirectoryUrl']);
    }

    private function urlGenerator(): UrlGeneratorInterface
    {
        $urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $urlGenerator->method('generate')->willReturnCallback(
            static fn (string $route): string => '/'.$route
        );

        return $urlGenerator;
    }
}
