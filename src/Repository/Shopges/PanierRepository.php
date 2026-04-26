<?php

declare(strict_types=1);

namespace App\Repository\Shopges;

use App\Entity\Shopges\Panier;
use App\Entity\Shopges\Produit;
use App\Entity\User;
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
    public function findCartItems(User $client): array
    {
        return $this->createQueryBuilder('panier')
            ->leftJoin('panier.produit', 'produit')
            ->addSelect('produit')
            ->andWhere('panier.client = :client')
            ->setParameter('client', $client)
            ->orderBy('panier.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findOneByClientAndProduit(User $client, Produit $produit): ?Panier
    {
        return $this->createQueryBuilder('panier')
            ->andWhere('panier.client = :client')
            ->andWhere('panier.produit = :produit')
            ->setParameter('client', $client)
            ->setParameter('produit', $produit)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return array<int, int>
     */
    public function getQuantitiesByProductId(User $client): array
    {
        $rows = $this->createQueryBuilder('panier')
            ->select('IDENTITY(panier.produit) AS produitId, panier.qty AS qty')
            ->andWhere('panier.client = :client')
            ->setParameter('client', $client)
            ->getQuery()
            ->getArrayResult();

        $quantities = [];
        foreach ($rows as $row) {
            $quantities[(int) $row['produitId']] = (int) $row['qty'];
        }

        return $quantities;
    }

    public function getCartQuantity(User $client): int
    {
        return (int) $this->createQueryBuilder('panier')
            ->select('COALESCE(SUM(panier.qty), 0)')
            ->andWhere('panier.client = :client')
            ->setParameter('client', $client)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getCartTotal(User $client): float
    {
        return (float) $this->createQueryBuilder('panier')
            ->select('COALESCE(SUM(panier.totalP - panier.totalt), 0)')
            ->andWhere('panier.client = :client')
            ->setParameter('client', $client)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findCartAbandonmentStats(): array
    {
        $thirtyDaysAgo = (new \DateTime())->modify('-30 days');

        $totalCarts = $this->createQueryBuilder('panier')
            ->select('COUNT(DISTINCT panier.client) as totalClients')
            ->getQuery()
            ->getSingleScalarResult();

        $abandonedCarts = $this->createQueryBuilder('panier')
            ->select('COUNT(DISTINCT panier.client) as abandonedClients')
            ->where('panier.createdAt <= :thirtyDaysAgo')
            ->setParameter('thirtyDaysAgo', $thirtyDaysAgo)
            ->getQuery()
            ->getSingleScalarResult();

        $rate = $totalCarts > 0 ? round(($abandonedCarts / $totalCarts) * 100, 1) : 0;

        return [
            'rate' => $rate,
            'totalCarts' => (int) $totalCarts,
            'abandonedCarts' => (int) $abandonedCarts,
        ];
    }
}



