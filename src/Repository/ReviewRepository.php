<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\VetReviewStatsRow;
use App\Entity\Review;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Review>
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    /**
     * @return array{
     *     note_moyenne: float,
     *     nombre_avis: int,
     *     taux_satisfaction: float|int,
     *     etoiles: float
     * }
     */
    public function getStatsParVet(int $vetId): array
    {
        $statsByVetId = $this->getStatsParVetIds([$vetId]);
        $stats = $statsByVetId[$vetId] ?? null;
        $noteMoyenne = $stats['note_moyenne'] ?? 0.0;

        return [
            'note_moyenne' => $noteMoyenne,
            'nombre_avis' => (int) ($stats['nombre_avis'] ?? 0),
            'taux_satisfaction' => $noteMoyenne > 0 ? round(($noteMoyenne / 5) * 100) : 0,
            'etoiles' => round($noteMoyenne),
        ];
    }

    /**
     * @param list<int> $vetIds
     * @return array<int, array{
     *     note_moyenne: float,
     *     nombre_avis: int,
     *     taux_satisfaction: float|int,
     *     etoiles: float
     * }>
     */
    public function getStatsParVetIds(array $vetIds): array
    {
        $vetIds = array_values(array_unique(array_filter($vetIds, static fn (int $vetId): bool => $vetId > 0)));
        if ($vetIds === []) {
            return [];
        }

        /** @var list<VetReviewStatsRow> $results */
        $results = $this->createQueryBuilder('r')
            ->select('NEW App\\Dto\\VetReviewStatsRow(IDENTITY(r.vet), AVG(r.note), COUNT(r.id))')
            ->where('r.vet IN (:vetIds)')
            ->setParameter('vetIds', $vetIds)
            ->groupBy('r.vet')
            ->getQuery()
            ->getResult();

        $statsByVetId = [];

        foreach ($results as $result) {
            $noteMoyenne = round($result->noteMoyenne, 1);
            $statsByVetId[$result->vetId] = [
                'note_moyenne' => $noteMoyenne,
                'nombre_avis' => $result->nombreAvis,
                'taux_satisfaction' => $noteMoyenne > 0 ? round(($noteMoyenne / 5) * 100) : 0,
                'etoiles' => round($noteMoyenne),
            ];
        }

        return $statsByVetId;
    }

    /**
     * @param list<int> $vetIds
     * @return list<int>
     */
    public function findReviewedVetIdsForClientAndVetIds(User $client, array $vetIds): array
    {
        $vetIds = array_values(array_unique(array_filter($vetIds, static fn (int $vetId): bool => $vetId > 0)));
        if ($vetIds === []) {
            return [];
        }

        $rows = $this->createQueryBuilder('r')
            ->select('IDENTITY(r.vet) AS vetId')
            ->where('r.client = :client')
            ->andWhere('r.vet IN (:vetIds)')
            ->setParameter('client', $client)
            ->setParameter('vetIds', $vetIds)
            ->groupBy('r.vet')
            ->getQuery()
            ->getScalarResult();

        return array_values(array_map(static fn (array $row): int => (int) $row['vetId'], $rows));
    }

    /**
     * @return list<array{vetId: int, noteMoyenne: float, nombreAvis: int}>
     */
    public function getStatsToutes(): array
    {
        /** @var list<VetReviewStatsRow> $results */
        $results = $this->createQueryBuilder('r')
            ->select('NEW App\\Dto\\VetReviewStatsRow(IDENTITY(r.vet), AVG(r.note), COUNT(r.id))')
            ->groupBy('r.vet')
            ->getQuery()
            ->getResult();

        return array_values(array_map(
            static fn (VetReviewStatsRow $result): array => [
                'vetId' => $result->vetId,
                'noteMoyenne' => $result->noteMoyenne,
                'nombreAvis' => $result->nombreAvis,
            ],
            $results
        ));
    }
}
