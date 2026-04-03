<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DashboardViewBuilder
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UrlGeneratorInterface $urlGenerator,
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
     *     userDirectoryUrl: string|null
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
        ];

        if (!$isAdmin) {
            return $viewData;
        }

        $viewData['stats'] = [
            'allUsers' => $this->userRepository->countAll(),
            'activeUsers' => $this->userRepository->countActive(),
            'verifiedUsers' => $this->userRepository->countVerified(),
            'admins' => $this->userRepository->countAdmins(),
            'pendingVeteranApplicants' => $this->userRepository->countVeteranApplicantsPending(),
        ];
        $viewData['pendingVeteranApplicants'] = $this->userRepository->findPendingVeteranApplicants();
        $viewData['recentUsers'] = $this->userRepository->findRecent();
        $viewData['adminUsersUrl'] = $this->urlGenerator->generate('admin_user_index');
        $viewData['userDirectoryUrl'] = $this->urlGenerator->generate('app_user_directory');

        return $viewData;
    }
}
