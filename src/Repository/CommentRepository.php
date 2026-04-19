<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comment>
 */
final class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    /**
     * @return list<Comment>
     */
    public function findActiveForPost(Post $post): array
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.author', 'author')
            ->addSelect('author')
            ->leftJoin('c.parentComment', 'parentComment')
            ->addSelect('parentComment')
            ->andWhere('c.post = :post')
            ->andWhere('c.status = :status')
            ->setParameter('post', $post)
            ->setParameter('status', 'ACTIVE')
            ->orderBy('c.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param list<Post> $posts
     *
     * @return list<Comment>
     */
    public function findActiveForPosts(array $posts): array
    {
        if ($posts === []) {
            return [];
        }

        return $this->createQueryBuilder('c')
            ->leftJoin('c.author', 'author')
            ->addSelect('author')
            ->leftJoin('c.parentComment', 'parentComment')
            ->addSelect('parentComment')
            ->andWhere('c.post IN (:posts)')
            ->andWhere('c.status = :status')
            ->setParameter('posts', $posts)
            ->setParameter('status', 'ACTIVE')
            ->orderBy('c.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function countActiveForPost(Post $post): int
    {
        return (int) $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->andWhere('c.post = :post')
            ->andWhere('c.status = :status')
            ->setParameter('post', $post)
            ->setParameter('status', 'ACTIVE')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
