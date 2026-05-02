<?php

declare(strict_types=1);

namespace App\Repository\Shopges;

use App\Entity\Shopges\Produit;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
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
        return $this->createShopSearchQueryBuilder($filters)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param array{q?: string, category?: string, min_price?: string, max_price?: string} $filters
     */
    public function createShopSearchQueryBuilder(array $filters): QueryBuilder
    {
        $qb = $this->createQueryBuilder('p')
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
                ->andWhere('(p.price - p.tva) >= :minPrice')
                ->setParameter('minPrice', (float) $minPrice);
        }

        $maxPrice = $filters['max_price'] ?? '';
        if ($maxPrice !== '' && is_numeric($maxPrice)) {
            $qb
                ->andWhere('(p.price - p.tva) <= :maxPrice')
                ->setParameter('maxPrice', (float) $maxPrice);
        }

        $category = strtolower(trim((string) ($filters['category'] ?? '')));
        if ($category !== '' && $category !== 'all') {
            $qb
                ->andWhere('p.category = :category')
                ->setParameter('category', $category);
        }

        return $qb;
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
        return $this->createManagementQueryBuilder($user, $isAdmin)
            ->getQuery()
            ->getResult();
    }

    public function createManagementQueryBuilder(User $user, bool $isAdmin): QueryBuilder
    {
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC');

        if ($isAdmin) {
            $qb
                ->leftJoin('p.owner', 'owner')
                ->addSelect('owner');
        } else {
            $qb
                ->andWhere('p.owner = :owner')
                ->setParameter('owner', $user);
        }

        return $qb;
    }

    public function countForManagement(User $user, bool $isAdmin): int
    {
        $qb = $this->createQueryBuilder('p')
            ->select('COUNT(p.id)');

        if (!$isAdmin) {
            $qb
                ->andWhere('p.owner = :owner')
                ->setParameter('owner', $user);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * @return list<int>
     */
    public function findManagementPageIds(User $user, bool $isAdmin, int $page, int $limit): array
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p.id')
            ->orderBy('p.id', 'DESC')
            ->setFirstResult(max(0, ($page - 1) * $limit))
            ->setMaxResults($limit);

        if (!$isAdmin) {
            $qb
                ->andWhere('p.owner = :owner')
                ->setParameter('owner', $user);
        }

        return array_map(
            static fn (array $row): int => (int) $row['id'],
            $qb->getQuery()->getScalarResult(),
        );
    }

    /**
     * @param list<int> $ids
     *
     * @return list<Produit>
     */
    public function findManagementPageByIds(array $ids, bool $withOwner): array
    {
        if ($ids === []) {
            return [];
        }

        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->orderBy('p.id', 'DESC');

        if ($withOwner) {
            $qb
                ->leftJoin('p.owner', 'owner')
                ->addSelect('owner');
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @return list<Produit>
     */
    public function findRecentForShopHero(int $limit = 3): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
