<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Reservation;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservation>
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    /**
     * @return Reservation[]
     */
    public function findForClient(User $client): array
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.hotel', 'hotel')
            ->addSelect('hotel')
            ->leftJoin('r.client', 'client')
            ->addSelect('client')
            ->leftJoin('r.animal', 'animal')
            ->addSelect('animal')
            ->andWhere('r.client = :client')
            ->setParameter('client', $client)
            ->orderBy('r.createdAt', 'DESC')
            ->addOrderBy('r.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Reservation[]
     */
    public function findAllOrdered(): array
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.hotel', 'hotel')
            ->addSelect('hotel')
            ->leftJoin('r.client', 'client')
            ->addSelect('client')
            ->leftJoin('r.animal', 'animal')
            ->addSelect('animal')
            ->orderBy('r.createdAt', 'DESC')
            ->addOrderBy('r.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
