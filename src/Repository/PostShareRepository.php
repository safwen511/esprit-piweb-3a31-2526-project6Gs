<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\PostShare;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PostShare>
 */
final class PostShareRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostShare::class);
    }

    /**
     * @return list<array{day:string,total:int}>
     */
    public function getDailyTotalsForAuthorPosts(int $userId, \DateTimeImmutable $since): array
    {
        $rows = $this->getEntityManager()->getConnection()->fetchAllAssociative(
            'SELECT DATE(ps.created_at) AS day, COUNT(ps.id) AS total
             FROM post_share ps
             INNER JOIN post p ON p.id = ps.post_id
             WHERE p.author_id = :userId AND ps.created_at >= :since
             GROUP BY DATE(ps.created_at)
             ORDER BY DATE(ps.created_at) ASC',
            [
                'userId' => $userId,
                'since' => $since->format('Y-m-d 00:00:00'),
            ],
        );

        return array_map(static fn (array $row): array => [
            'day' => (string) $row['day'],
            'total' => (int) $row['total'],
        ], $rows);
    }
}
