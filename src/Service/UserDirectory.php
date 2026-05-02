<?php

namespace App\Service;

use App\Model\UserSearchData;
use App\Repository\UserRepository;
use App\Entity\User;

class UserDirectory
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @return list<User>
     */
    public function search(UserSearchData $searchData): array
    {
        return $this->userRepository->searchByFilters($searchData);
    }
}
