<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\FriendRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FriendRequest>
 */
final class FriendRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FriendRequest::class);
    }

    /**
     * @return list<FriendRequest>
     */
    public function findPendingReceivedForUser(int $userId): array
    {
        return $this->createQueryBuilder('request')
            ->andWhere('request.receiverId = :userId')
            ->andWhere('request.status = :status')
            ->setParameter('userId', $userId)
            ->setParameter('status', 'PENDING')
            ->orderBy('request.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return list<int>
     */
    public function findPendingSentUserIds(int $userId): array
    {
        return array_map(
            static fn (mixed $value): int => (int) $value,
            $this->createQueryBuilder('request')
                ->select('request.receiverId')
                ->andWhere('request.senderId = :userId')
                ->andWhere('request.status = :status')
                ->setParameter('userId', $userId)
                ->setParameter('status', 'PENDING')
                ->getQuery()
                ->getSingleColumnResult(),
        );
    }

    public function findLatestBetweenUsers(int $firstUserId, int $secondUserId): ?FriendRequest
    {
        return $this->createQueryBuilder('request')
            ->andWhere('(request.senderId = :firstUserId AND request.receiverId = :secondUserId) OR (request.senderId = :secondUserId AND request.receiverId = :firstUserId)')
            ->setParameter('firstUserId', $firstUserId)
            ->setParameter('secondUserId', $secondUserId)
            ->orderBy('request.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findPendingFromSenderToReceiver(int $senderId, int $receiverId): ?FriendRequest
    {
        return $this->createQueryBuilder('request')
            ->andWhere('request.senderId = :senderId')
            ->andWhere('request.receiverId = :receiverId')
            ->andWhere('request.status = :status')
            ->setParameter('senderId', $senderId)
            ->setParameter('receiverId', $receiverId)
            ->setParameter('status', 'PENDING')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
