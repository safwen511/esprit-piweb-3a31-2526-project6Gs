<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\PostReaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PostReaction>
 */
final class PostReactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostReaction::class);
    }

    public function findOneForPostAndUser(int $postId, int $userId): ?PostReaction
    {
        return $this->createQueryBuilder('reaction')
            ->andWhere('reaction.postId = :postId')
            ->andWhere('reaction.userId = :userId')
            ->setParameter('postId', $postId)
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function countForPostAndReaction(int $postId, string $reaction): int
    {
        return (int) $this->createQueryBuilder('reaction')
            ->select('COUNT(reaction.id)')
            ->andWhere('reaction.postId = :postId')
            ->andWhere('reaction.reaction = :reaction')
            ->setParameter('postId', $postId)
            ->setParameter('reaction', $reaction)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @param list<int> $postIds
     *
     * @return array<int, string>
     */
    public function findUserReactionsForPosts(array $postIds, int $userId): array
    {
        if ($postIds === []) {
            return [];
        }

        $rows = $this->createQueryBuilder('reaction')
            ->select('reaction.postId', 'reaction.reaction')
            ->andWhere('reaction.postId IN (:postIds)')
            ->andWhere('reaction.userId = :userId')
            ->setParameter('postIds', $postIds)
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getArrayResult();

        $map = [];
        foreach ($rows as $row) {
            $map[(int) $row['postId']] = (string) $row['reaction'];
        }

        return $map;
    }

    /**
     * @return list<array{day:string,reaction:string,total:int}>
     */
    public function getDailyTotalsForAuthorPosts(int $userId, \DateTimeImmutable $since): array
    {
        $rows = $this->getEntityManager()->getConnection()->fetchAllAssociative(
            'SELECT DATE(pr.created_at) AS day, UPPER(pr.reaction) AS reaction, COUNT(pr.id) AS total
             FROM post_reaction pr
             INNER JOIN post p ON p.id = pr.post_id
             WHERE p.author_id = :userId AND pr.created_at >= :since
             GROUP BY DATE(pr.created_at), UPPER(pr.reaction)
             ORDER BY DATE(pr.created_at) ASC',
            [
                'userId' => $userId,
                'since' => $since->format('Y-m-d 00:00:00'),
            ],
        );

        return array_map(static fn (array $row): array => [
            'day' => (string) $row['day'],
            'reaction' => (string) $row['reaction'],
            'total' => (int) $row['total'],
        ], $rows);
    }
}
