<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Panier;
use App\Entity\Produit;
<<<<<<< HEAD
use App\Entity\User;
=======
>>>>>>> origin/integrationv11
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
<<<<<<< HEAD
    public function findCartItems(User $client): array
=======
    public function findCartItems(int $clientId): array
>>>>>>> origin/integrationv11
    {
        return $this->createQueryBuilder('panier')
            ->leftJoin('panier.produit', 'produit')
            ->addSelect('produit')
<<<<<<< HEAD
            ->andWhere('panier.client = :client')
            ->setParameter('client', $client)
=======
            ->andWhere('panier.clientId = :clientId')
            ->setParameter('clientId', $clientId)
>>>>>>> origin/integrationv11
            ->orderBy('panier.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

<<<<<<< HEAD
    public function findOneByClientAndProduit(User $client, Produit $produit): ?Panier
    {
        return $this->createQueryBuilder('panier')
            ->andWhere('panier.client = :client')
            ->andWhere('panier.produit = :produit')
            ->setParameter('client', $client)
=======
    public function findOneByClientAndProduit(int $clientId, Produit $produit): ?Panier
    {
        return $this->createQueryBuilder('panier')
            ->andWhere('panier.clientId = :clientId')
            ->andWhere('panier.produit = :produit')
            ->setParameter('clientId', $clientId)
>>>>>>> origin/integrationv11
            ->setParameter('produit', $produit)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return array<int, int>
     */
<<<<<<< HEAD
    public function getQuantitiesByProductId(User $client): array
    {
        $rows = $this->createQueryBuilder('panier')
            ->select('IDENTITY(panier.produit) AS produitId, panier.qty AS qty')
            ->andWhere('panier.client = :client')
            ->setParameter('client', $client)
=======
    public function getQuantitiesByProductId(int $clientId): array
    {
        $rows = $this->createQueryBuilder('panier')
            ->select('IDENTITY(panier.produit) AS produitId, panier.qty AS qty')
            ->andWhere('panier.clientId = :clientId')
            ->setParameter('clientId', $clientId)
>>>>>>> origin/integrationv11
            ->getQuery()
            ->getArrayResult();

        $quantities = [];
        foreach ($rows as $row) {
            $quantities[(int) $row['produitId']] = (int) $row['qty'];
        }

        return $quantities;
    }

<<<<<<< HEAD
    public function getCartQuantity(User $client): int
    {
        return (int) $this->createQueryBuilder('panier')
            ->select('COALESCE(SUM(panier.qty), 0)')
            ->andWhere('panier.client = :client')
            ->setParameter('client', $client)
=======
    public function getCartQuantity(int $clientId): int
    {
        return (int) $this->createQueryBuilder('panier')
            ->select('COALESCE(SUM(panier.qty), 0)')
            ->andWhere('panier.clientId = :clientId')
            ->setParameter('clientId', $clientId)
>>>>>>> origin/integrationv11
            ->getQuery()
            ->getSingleScalarResult();
    }

<<<<<<< HEAD
    public function getCartTotal(User $client): float
    {
        return (float) $this->createQueryBuilder('panier')
            ->select('COALESCE(SUM(panier.totalP - panier.totalt), 0)')
            ->andWhere('panier.client = :client')
            ->setParameter('client', $client)
=======
    public function getCartTotal(int $clientId): float
    {
        return (float) $this->createQueryBuilder('panier')
            ->select('COALESCE(SUM(panier.totalP - panier.totalt), 0)')
            ->andWhere('panier.clientId = :clientId')
            ->setParameter('clientId', $clientId)
>>>>>>> origin/integrationv11
            ->getQuery()
            ->getSingleScalarResult();
    }
}
