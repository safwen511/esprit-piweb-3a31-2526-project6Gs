<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Rendezvous;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rendezvous>
 */
final class RendezvousRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rendezvous::class);
    }

    /**
     * @return list<Rendezvous>
     */
    public function findForClientWithDetails(User $client): array
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.vet', 'vet')
            ->addSelect('vet')
            ->leftJoin('r.animal', 'animal')
            ->addSelect('animal')
            ->andWhere('r.client = :client')
            ->setParameter('client', $client)
            ->orderBy('r.appointmentDate', 'DESC')
            ->addOrderBy('r.appointmentTime', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
