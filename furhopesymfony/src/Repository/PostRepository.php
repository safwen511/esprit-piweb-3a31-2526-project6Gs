<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 */
final class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @return list<Post>
     */
    public function findFeedPosts(?User $viewer = null, array $friendIds = []): array
    {
        $queryBuilder = $this->createVisiblePostsQueryBuilder();
        $this->applyVisibilityFilter($queryBuilder, $viewer, $friendIds);

        return $queryBuilder
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findOneVisiblePost(int $id, ?User $viewer = null, array $friendIds = []): ?Post
    {
        $queryBuilder = $this->createVisiblePostsQueryBuilder()
            ->andWhere('p.id = :id')
            ->setParameter('id', $id);

        $this->applyVisibilityFilter($queryBuilder, $viewer, $friendIds);

        return $queryBuilder
            ->getQuery()
            ->getOneOrNullResult();
    }

    private function createVisiblePostsQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.author', 'author')
            ->addSelect('author')
            ->andWhere('p.status = :status')
            ->setParameter('status', 'ACTIVE');
    }

    private function applyVisibilityFilter(QueryBuilder $queryBuilder, ?User $viewer, array $friendIds): void
    {
        if ($viewer === null || $viewer->getId() === null) {
            $queryBuilder
                ->andWhere('p.visibility = :publicVisibility')
                ->setParameter('publicVisibility', 'PUBLIC');

            return;
        }

        $visibilityExpression = $queryBuilder->expr()->orX(
            'p.author = :viewer',
            'p.visibility = :publicVisibility',
        );

        if ($friendIds !== []) {
            $visibilityExpression->add(
                $queryBuilder->expr()->andX(
                    'p.visibility = :friendsVisibility',
                    $queryBuilder->expr()->in('author.id', ':friendIds'),
                ),
            );

            $queryBuilder
                ->setParameter('friendIds', array_values(array_unique(array_map('intval', $friendIds))))
                ->setParameter('friendsVisibility', 'FRIENDS');
        }

        $queryBuilder
            ->andWhere($visibilityExpression)
            ->setParameter('viewer', $viewer)
            ->setParameter('publicVisibility', 'PUBLIC');
    }
}
