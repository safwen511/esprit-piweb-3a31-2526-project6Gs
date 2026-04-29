<?php

namespace App\Service;

use App\Model\UserSearchData;
use App\Repository\UserRepository;

class UserDirectory
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @return list<\App\Entity\User>
     */
    public function search(UserSearchData $searchData): array
    {
        return $this->userRepository->searchByFilters($searchData);
    }
}
