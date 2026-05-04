<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DashboardViewBuilder
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly CacheInterface $cache,
    ) {
    }

    /**
     * @return array{
     *     member: User,
     *     isAdmin: bool,
     *     stats: array<string, int>|null,
     *     pendingVeteranApplicants: list<User>,
     *     recentUsers: list<User>,
     *     adminUsersUrl: string|null,
     *     userDirectoryUrl: string|null,
     *     productManagementUrl: string,
     *     animalManagementUrl: string,
     *     socialManagementUrl: string
     * }
     */
    public function build(User $user, bool $isAdmin): array
    {
        $viewData = [
            'member' => $user,
            'isAdmin' => $isAdmin,
            'stats' => null,
            'pendingVeteranApplicants' => [],
            'recentUsers' => [],
            'adminUsersUrl' => null,
            'userDirectoryUrl' => null,
            'productManagementUrl' => $this->urlGenerator->generate('app_shop_management'),
            'animalManagementUrl' => $this->urlGenerator->generate('app_animal_management'),
            'socialManagementUrl' => $this->urlGenerator->generate('app_social_management'),
        ];

        if (!$isAdmin) {
            return $viewData;
        }

        $viewData['stats'] = $this->cache->get('dashboard.stats', function (ItemInterface $item): array {
            $item->expiresAfter(60);

            return $this->userRepository->getDashboardStats();
        });
        $viewData['pendingVeteranApplicants'] = $this->cache->get('dashboard.pending_veteran_applicants', function (ItemInterface $item): array {
            $item->expiresAfter(60);

            return $this->userRepository->findPendingVeteranApplicants();
        });
        $viewData['recentUsers'] = $this->cache->get('dashboard.recent_users', function (ItemInterface $item): array {
            $item->expiresAfter(60);

            return $this->userRepository->findRecent();
        });
        $viewData['adminUsersUrl'] = $this->urlGenerator->generate('admin_user_index');
        $viewData['userDirectoryUrl'] = $this->urlGenerator->generate('app_user_directory');

        return $viewData;
    }
}
