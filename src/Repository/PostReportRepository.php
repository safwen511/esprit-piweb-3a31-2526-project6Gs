<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\PostReport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PostReport>
 */
final class PostReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostReport::class);
    }

    public function hasUserReported(int $postId, int $reporterUserId): bool
    {
        return (int) $this->createQueryBuilder('report')
            ->select('COUNT(report.id)')
            ->andWhere('report.postId = :postId')
            ->andWhere('report.reporterUserId = :reporterUserId')
            ->setParameter('postId', $postId)
            ->setParameter('reporterUserId', $reporterUserId)
            ->getQuery()
            ->getSingleScalarResult() > 0;
    }

    /**
     * @param list<int> $postIds
     *
     * @return list<int>
     */
    public function findReportedPostIdsForUser(array $postIds, int $reporterUserId): array
    {
        if ($postIds === []) {
            return [];
        }

        return array_map(
            static fn (mixed $value): int => (int) $value,
            $this->createQueryBuilder('report')
                ->select('report.postId')
                ->andWhere('report.postId IN (:postIds)')
                ->andWhere('report.reporterUserId = :reporterUserId')
                ->setParameter('postIds', $postIds)
                ->setParameter('reporterUserId', $reporterUserId)
                ->getQuery()
                ->getSingleColumnResult(),
        );
    }
}
