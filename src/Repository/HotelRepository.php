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
        return $this->createQueryBuilder('h')
            ->leftJoin('h.manager', 'manager')
            ->addSelect('manager')
            ->orderBy('h.createdAt', 'DESC')
            ->addOrderBy('h.name', 'ASC')
            ->setFirstResult(max(0, $offset))
            ->setMaxResults(max(1, $limit))
            ->getQuery()
            ->getResult();
    }

    public function countAll(): int
    {
        return (int) $this->createQueryBuilder('h')
            ->select('COUNT(h.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
