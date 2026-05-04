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
     * @param list<int> $friendIds
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

    /**
     * @param list<int> $friendIds
     */
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

    /**
     * @return list<Post>
     */
    public function findByAuthor(User $author): array
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.author', 'author')
            ->addSelect('author')
            ->andWhere('p.author = :author')
            ->setParameter('author', $author)
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array{posts:int, likes:int, dislikes:int, shares:int, comments:int}
     */
    public function getAuthorOverview(int $userId): array
    {
        $row = $this->getEntityManager()->getConnection()->fetchAssociative(
            'SELECT COUNT(id) AS posts, COALESCE(SUM(likes_count), 0) AS likes, COALESCE(SUM(dislikes_count), 0) AS dislikes, COALESCE(SUM(shares_count), 0) AS shares, COALESCE(SUM(comments_count), 0) AS comments
             FROM post
             WHERE author_id = :userId',
            ['userId' => $userId],
        );

        return [
            'posts' => (int) ($row['posts'] ?? 0),
            'likes' => (int) ($row['likes'] ?? 0),
            'dislikes' => (int) ($row['dislikes'] ?? 0),
            'shares' => (int) ($row['shares'] ?? 0),
            'comments' => (int) ($row['comments'] ?? 0),
        ];
    }

    private function createVisiblePostsQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.author', 'author')
            ->addSelect('author')
            ->andWhere('p.status = :status')
            ->setParameter('status', 'ACTIVE');
    }

    /**
     * @param list<int> $friendIds
     */
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
