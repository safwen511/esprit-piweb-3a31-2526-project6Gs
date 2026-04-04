<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    public function findByOwner(User $owner): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.owner = :owner')
            ->setParameter('owner', $owner)
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findBySpeciesInsensitive(string $species): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('LOWER(a.type) = :species')
            ->setParameter('species', mb_strtolower(trim($species)))
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

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

        return array_map(static fn(array $row) => [
            'value' => $row['normalizedSpecies'],
            'label' => ucfirst(mb_strtolower($row['displaySpecies'])),
        ], $rows);
    }

    public function findByFilters(
        ?string $species = null,
        ?int $minAge = null,
        ?int $maxAge = null,
        ?string $status = null,
        ?string $gender = null,
    ): array {
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
}
