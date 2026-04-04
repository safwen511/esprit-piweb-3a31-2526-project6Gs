<?php

namespace App\Repository;

use App\Entity\AdoptionRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AdoptionRequest>
 */
class AdoptionRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdoptionRequest::class);
    }

    /**
     * @return AdoptionRequest[]
     */
    public function findPendingForOwner(int $ownerId): array
    {
        return $this->createQueryBuilder('ar')
            ->innerJoin('ar.animal', 'a')
            ->innerJoin('a.owner', 'o')
            ->andWhere('o.id = :ownerId')
            ->andWhere('ar.status = :status')
            ->setParameter('ownerId', $ownerId)
            ->setParameter('status', 'PENDING')
            ->orderBy('ar.requestDate', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function countPendingForOwner(int $ownerId): int
    {
        return (int) $this->createQueryBuilder('ar')
            ->select('COUNT(ar.id)')
            ->innerJoin('ar.animal', 'a')
            ->innerJoin('a.owner', 'o')
            ->andWhere('o.id = :ownerId')
            ->andWhere('ar.status = :status')
            ->setParameter('ownerId', $ownerId)
            ->setParameter('status', 'PENDING')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findPendingOwnedRequest(int $requestId, int $ownerId): ?AdoptionRequest
    {
        return $this->createQueryBuilder('ar')
            ->innerJoin('ar.animal', 'a')
            ->innerJoin('a.owner', 'o')
            ->andWhere('ar.id = :requestId')
            ->andWhere('o.id = :ownerId')
            ->andWhere('ar.status = :status')
            ->setParameter('requestId', $requestId)
            ->setParameter('ownerId', $ownerId)
            ->setParameter('status', 'PENDING')
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return AdoptionRequest[]
     */
    public function findForClient(int $clientId): array
    {
        return $this->createQueryBuilder('ar')
            ->innerJoin('ar.animal', 'a')
            ->leftJoin('a.owner', 'o')
            ->addSelect('a', 'o')
            ->andWhere('ar.clientId = :clientId')
            ->setParameter('clientId', $clientId)
            ->orderBy('ar.requestDate', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findPendingForClient(int $requestId, int $clientId): ?AdoptionRequest
    {
        return $this->createQueryBuilder('ar')
            ->innerJoin('ar.animal', 'a')
            ->leftJoin('a.owner', 'o')
            ->addSelect('a', 'o')
            ->andWhere('ar.id = :requestId')
            ->andWhere('ar.clientId = :clientId')
            ->andWhere('ar.status = :status')
            ->setParameter('requestId', $requestId)
            ->setParameter('clientId', $clientId)
            ->setParameter('status', 'PENDING')
            ->getQuery()
            ->getOneOrNullResult();
    }
}
