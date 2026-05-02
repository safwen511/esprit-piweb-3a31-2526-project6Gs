<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\AdoptionRequest;
use App\Entity\Animal;
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

    /**
     * @return list<array{animal: Animal, totalRequests: int}>
     */
    public function findTopRequestedAnimals(int $limit = 3): array
    {
        $rows = $this->getEntityManager()->createQueryBuilder()
            ->select('a AS animal', 'COUNT(ar.id) AS totalRequests')
            ->from(Animal::class, 'a')
            ->innerJoin(AdoptionRequest::class, 'ar', 'WITH', 'ar.animal = a')
            ->groupBy('a.id')
            ->orderBy('totalRequests', 'DESC')
            ->addOrderBy('a.name', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        $topAnimals = [];
        foreach ($rows as $row) {
            $animal = $row['animal'] ?? null;
            if (!$animal instanceof Animal) {
                continue;
            }

            $topAnimals[] = [
                'animal' => $animal,
                'totalRequests' => (int) ($row['totalRequests'] ?? 0),
            ];
        }

        return $topAnimals;
    }

    /**
     * @return list<array{animal: Animal, totalRequests: int}>
     */
    public function countRequestsPerAnimal(): array
    {
        $rows = $this->getEntityManager()->createQueryBuilder()
            ->select('a AS animal', 'COUNT(ar.id) AS totalRequests')
            ->from(Animal::class, 'a')
            ->innerJoin(AdoptionRequest::class, 'ar', 'WITH', 'ar.animal = a')
            ->groupBy('a.id')
            ->orderBy('totalRequests', 'DESC')
            ->addOrderBy('a.name', 'ASC')
            ->getQuery()
            ->getResult();

        $requestCounts = [];
        foreach ($rows as $row) {
            $animal = $row['animal'] ?? null;
            if (!$animal instanceof Animal) {
                continue;
            }

            $requestCounts[] = [
                'animal' => $animal,
                'totalRequests' => (int) ($row['totalRequests'] ?? 0),
            ];
        }

        return $requestCounts;
    }

    /**
     * @return list<array{date: string, totalRequests: int}>
     */
    public function countDailyTrends(int $days = 30): array
    {
        $days = max(1, $days);
        $startDate = (new \DateTimeImmutable(sprintf('-%d days', $days - 1)))->setTime(0, 0, 0);
        $endDate = (new \DateTimeImmutable('now'))->setTime(23, 59, 59);

        $rows = $this->createQueryBuilder('ar')
            ->select('ar.requestDate AS requestDate')
            ->andWhere('ar.requestDate BETWEEN :startDate AND :endDate')
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->orderBy('ar.requestDate', 'ASC')
            ->getQuery()
            ->getArrayResult();

        $countsByDay = [];
        for ($index = 0; $index < $days; ++$index) {
            $dateKey = $startDate->modify(sprintf('+%d day', $index))->format('Y-m-d');
            $countsByDay[$dateKey] = 0;
        }

        foreach ($rows as $row) {
            $dateKey = null;
            $value = $row['requestDate'] ?? null;

            if ($value instanceof \DateTimeInterface) {
                $dateKey = $value->format('Y-m-d');
            } elseif (is_string($value) && '' !== $value) {
                $dateKey = (new \DateTimeImmutable($value))->format('Y-m-d');
            }

            if ($dateKey !== null && array_key_exists($dateKey, $countsByDay)) {
                ++$countsByDay[$dateKey];
            }
        }

        $trend = [];
        foreach ($countsByDay as $date => $totalRequests) {
            $trend[] = [
                'date' => $date,
                'totalRequests' => $totalRequests,
            ];
        }

        return $trend;
    }

    public function rejectOtherPendingForAnimal(int $animalId, int $keepRequestId): int
    {
        return (int) $this->createQueryBuilder('ar')
            ->update()
            ->set('ar.status', ':rejected')
            ->andWhere('ar.animal = :animalId')
            ->andWhere('ar.status = :pending')
            ->andWhere('ar.id <> :keepId')
            ->setParameter('rejected', 'REJECTED')
            ->setParameter('pending', 'PENDING')
            ->setParameter('animalId', $animalId)
            ->setParameter('keepId', $keepRequestId)
            ->getQuery()
            ->execute();
    }
}
