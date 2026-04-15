<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Produit;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produit>
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    /**
     * @param array{q?: string, category?: string, min_price?: string, max_price?: string} $filters
     *
     * @return list<Produit>
     */
    public function searchForShop(array $filters): array
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.owner', 'owner')
            ->addSelect('owner')
            ->orderBy('p.id', 'DESC');

        $search = trim((string) ($filters['q'] ?? ''));
        if ($search !== '') {
            $qb
                ->andWhere('LOWER(p.title) LIKE LOWER(:search)')
                ->setParameter('search', '%'.$search.'%');
        }

        $minPrice = $filters['min_price'] ?? '';
        if ($minPrice !== '' && is_numeric($minPrice)) {
            $qb
                ->andWhere('p.price >= :minPrice')
                ->setParameter('minPrice', (float) $minPrice);
        }

        $maxPrice = $filters['max_price'] ?? '';
        if ($maxPrice !== '' && is_numeric($maxPrice)) {
            $qb
                ->andWhere('p.price <= :maxPrice')
                ->setParameter('maxPrice', (float) $maxPrice);
        }

        $category = strtolower(trim((string) ($filters['category'] ?? '')));
        if ($category !== '' && $category !== 'all') {
            $qb
                ->andWhere('p.category = :category')
                ->setParameter('category', $category);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @return array<string, string>
     */
    public function getAvailableCategories(): array
    {
        return Produit::allowedCategories();
    }

    /**
     * @return list<Produit>
     */
    public function findForManagement(User $user, bool $isAdmin): array
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.owner', 'owner')
            ->addSelect('owner')
            ->orderBy('p.id', 'DESC');

        if (!$isAdmin) {
            $qb
                ->andWhere('p.owner = :owner')
                ->setParameter('owner', $user);
        }

        return $qb->getQuery()->getResult();
    }
}
