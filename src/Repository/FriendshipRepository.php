<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Friendship;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Friendship>
 */
final class FriendshipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Friendship::class);
    }

    /**
     * @return list<int>
     */
    public function findFriendIdsForUser(int $userId): array
    {
        $rows = $this->createQueryBuilder('friendship')
            ->select('friendship.user1Id', 'friendship.user2Id')
            ->andWhere('friendship.user1Id = :userId OR friendship.user2Id = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getArrayResult();

        $friendIds = [];
        foreach ($rows as $row) {
            $firstId = (int) ($row['user1Id'] ?? 0);
            $secondId = (int) ($row['user2Id'] ?? 0);
            $friendIds[] = $firstId === $userId ? $secondId : $firstId;
        }

        return array_values(array_unique(array_filter($friendIds)));
    }

    public function existsBetweenUsers(int $firstUserId, int $secondUserId): bool
    {
        return (int) $this->createQueryBuilder('friendship')
            ->select('COUNT(friendship.id)')
            ->andWhere('(friendship.user1Id = :firstUserId AND friendship.user2Id = :secondUserId) OR (friendship.user1Id = :secondUserId AND friendship.user2Id = :firstUserId)')
            ->setParameter('firstUserId', $firstUserId)
            ->setParameter('secondUserId', $secondUserId)
            ->getQuery()
            ->getSingleScalarResult() > 0;
    }
}
