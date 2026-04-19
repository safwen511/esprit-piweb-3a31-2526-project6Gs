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
}
