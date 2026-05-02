<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Hotel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Hotel>
 */
class HotelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hotel::class);
    }

    /**
     * @return Hotel[]
     */
    public function findAllOrdered(): array
    {
        return $this->createQueryBuilder('h')
            ->leftJoin('h.manager', 'manager')
            ->addSelect('manager')
            ->orderBy('h.createdAt', 'DESC')
            ->addOrderBy('h.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Hotel[]
     */
    public function findPageOrdered(int $limit = 12, int $offset = 0): array
    {
        $limit = max(1, $limit);
        $offset = max(0, $offset);

        $rows = $this->createQueryBuilder('h')
            ->select('h.id')
            ->orderBy('h.createdAt', 'DESC')
            ->addOrderBy('h.name', 'ASC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();

        $ids = array_values(array_filter(array_map(static fn (array $row): int => (int) $row['id'], $rows)));
        if ($ids === []) {
            return [];
        }

        $hotels = $this->createQueryBuilder('h')
            ->leftJoin('h.manager', 'manager')
            ->addSelect('manager')
            ->andWhere('h.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->orderBy('h.createdAt', 'DESC')
            ->addOrderBy('h.name', 'ASC')
            ->getQuery()
            ->getResult();

        $indexedHotels = [];
        foreach ($hotels as $hotel) {
            if ($hotel instanceof Hotel && $hotel->getId() !== null) {
                $indexedHotels[$hotel->getId()] = $hotel;
            }
        }

        return array_values(array_filter(array_map(
            static fn (int $id): ?Hotel => $indexedHotels[$id] ?? null,
            $ids,
        )));
    }

    public function countAll(): int
    {
        return (int) $this->createQueryBuilder('h')
            ->select('COUNT(h.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
