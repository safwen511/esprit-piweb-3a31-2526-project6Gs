<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\AdoptionRequest;
use App\Entity\Animal;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Animal>
 */
class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    /**
     * @return Animal[]
     */
    public function findByOwner(User $owner): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.owner = :owner')
            ->setParameter('owner', $owner)
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return list<array{value: string, label: string}>
     */
    public function findDistinctSpecies(): array
    {
        $rows = $this->createQueryBuilder('a')
            ->select('DISTINCT LOWER(a.type) AS normalizedSpecies, MIN(a.type) AS displaySpecies')
            ->andWhere('a.type IS NOT NULL')
            ->andWhere("TRIM(a.type) <> ''")
            ->groupBy('normalizedSpecies')
            ->orderBy('displaySpecies', 'ASC')
            ->getQuery()
            ->getArrayResult();

        $species = [];
        foreach ($rows as $row) {
            $value = (string) ($row['normalizedSpecies'] ?? '');
            if ($value === '') {
                continue;
            }

            $label = (string) ($row['displaySpecies'] ?? $value);
            $species[] = [
                'value' => $value,
                'label' => ucfirst(mb_strtolower($label)),
            ];
        }

        return $species;
    }

    /**
     * @return Animal[]
     */
    public function findByFilters(?string $species = null, ?int $minAge = null, ?int $maxAge = null, ?string $status = null, ?string $gender = null): array
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC');

        if ($species !== null && $species !== '') {
            $qb->andWhere('LOWER(a.type) = :species')
                ->setParameter('species', mb_strtolower(trim($species)));
        }

        if ($minAge !== null) {
            $qb->andWhere('a.age >= :minAge')
                ->setParameter('minAge', $minAge);
        }

        if ($maxAge !== null) {
            $qb->andWhere('a.age <= :maxAge')
                ->setParameter('maxAge', $maxAge);
        }

        if ($status !== null && $status !== '') {
            $qb->andWhere('LOWER(a.status) = :status')
                ->setParameter('status', mb_strtolower($status));
        }

        if ($gender !== null && $gender !== '') {
            $qb->andWhere('LOWER(a.gender) = :gender')
                ->setParameter('gender', mb_strtolower($gender));
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @return Animal[]
     */
    public function findNeverRequested(int $limit = 25): array
    {
        return $this->createQueryBuilder('a')
            ->leftJoin(AdoptionRequest::class, 'ar', 'WITH', 'ar.animal = a')
            ->andWhere('ar.id IS NULL')
            ->orderBy('a.name', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return list<array{animal: Animal, totalRequests: int}>
     */
    public function findTopRequestedAnimals(int $limit = 3): array
    {
        $rows = $this->createQueryBuilder('a')
            ->select('a', 'COUNT(ar.id) AS totalRequests')
            ->innerJoin(AdoptionRequest::class, 'ar', 'WITH', 'ar.animal = a')
            ->groupBy('a.id')
            ->orderBy('totalRequests', 'DESC')
            ->addOrderBy('a.name', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        $topAnimals = [];
        foreach ($rows as $row) {
            $animal = $row[0] ?? null;
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
        $rows = $this->createQueryBuilder('a')
            ->select('a', 'COUNT(ar.id) AS totalRequests')
            ->innerJoin(AdoptionRequest::class, 'ar', 'WITH', 'ar.animal = a')
            ->groupBy('a.id')
            ->orderBy('totalRequests', 'DESC')
            ->addOrderBy('a.name', 'ASC')
            ->getQuery()
            ->getResult();

        $requestCounts = [];
        foreach ($rows as $row) {
            $animal = $row[0] ?? null;
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
}
