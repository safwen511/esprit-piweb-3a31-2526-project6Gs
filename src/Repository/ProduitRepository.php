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

    /**
     * @return list<array{category: string, total: int}>
     */
    public function findTopCategories(int $limit = 5): array
    {
        $rows = $this->createQueryBuilder('p')
            ->select('p.category, COUNT(p.id) as total')
            ->groupBy('p.category')
            ->orderBy('total', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();

        return array_values(array_map(static fn (array $row): array => [
            'category' => (string) $row['category'],
            'total' => (int) $row['total'],
        ], $rows));
    }

    /**
     * @return array{total: int, lowStockItems: list<array{title: string, stock: int, category: string}>}
     */
    public function findInventoryStats(): array
    {
        $total = $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $lowStock = $this->createQueryBuilder('p')
            ->select('p.title, p.stock, p.category')
            ->where('p.stock <= 10')
            ->orderBy('p.stock')
            ->getQuery()
            ->getArrayResult();

        return [
            'total' => (int) $total,
            'lowStockItems' => array_values(array_map(static fn (array $row): array => [
                'title' => (string) $row['title'],
                'stock' => (int) $row['stock'],
                'category' => (string) $row['category'],
            ], $lowStock)),
        ];
    }

    /**
     * @return array{avg: float, min: float, max: float}
     */
    public function findPriceStats(): array
    {
        $result = $this->createQueryBuilder('p')
            ->select('AVG(p.price) as avg, MIN(p.price) as min, MAX(p.price) as max')
            ->getQuery()
            ->getSingleResult();

        return [
            'avg' => round((float) ($result['avg'] ?? 0), 2),
            'min' => (float) ($result['min'] ?? 0),
            'max' => (float) ($result['max'] ?? 0),
        ];
    }
}
