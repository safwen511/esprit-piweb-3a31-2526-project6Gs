<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Panier;
use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Panier>
 */
class PanierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Panier::class);
    }

    /**
     * @return list<Panier>
     */
    public function findCartItems(int $clientId): array
    {
        return $this->createQueryBuilder('panier')
            ->leftJoin('panier.produit', 'produit')
            ->addSelect('produit')
            ->andWhere('panier.clientId = :clientId')
            ->setParameter('clientId', $clientId)
            ->orderBy('panier.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findOneByClientAndProduit(int $clientId, Produit $produit): ?Panier
    {
        return $this->createQueryBuilder('panier')
            ->andWhere('panier.clientId = :clientId')
            ->andWhere('panier.produit = :produit')
            ->setParameter('clientId', $clientId)
            ->setParameter('produit', $produit)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return array<int, int>
     */
    public function getQuantitiesByProductId(int $clientId): array
    {
        $rows = $this->createQueryBuilder('panier')
            ->select('IDENTITY(panier.produit) AS produitId, panier.qty AS qty')
            ->andWhere('panier.clientId = :clientId')
            ->setParameter('clientId', $clientId)
            ->getQuery()
            ->getArrayResult();

        $quantities = [];
        foreach ($rows as $row) {
            $quantities[(int) $row['produitId']] = (int) $row['qty'];
        }

        return $quantities;
    }

    public function getCartQuantity(int $clientId): int
    {
        return (int) $this->createQueryBuilder('panier')
            ->select('COALESCE(SUM(panier.qty), 0)')
            ->andWhere('panier.clientId = :clientId')
            ->setParameter('clientId', $clientId)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getCartTotal(int $clientId): float
    {
        return (float) $this->createQueryBuilder('panier')
            ->select('COALESCE(SUM(panier.totalP - panier.totalt), 0)')
            ->andWhere('panier.clientId = :clientId')
            ->setParameter('clientId', $clientId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
