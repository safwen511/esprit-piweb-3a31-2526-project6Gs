<?php

namespace App\Repository;

use App\Entity\FaceCredential;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FaceCredential>
 */
class FaceCredentialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FaceCredential::class);
    }

    /** @return FaceCredential[] */
    public function findForUser(User $user): array
    {
        return $this->findBy(['user' => $user]);
    }
}
