<?php
// src/Repository/ReviewRepository.php
namespace App\Repository;

use App\Entity\Review;
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
     * @return array{note_moyenne: float, nombre_avis: int, taux_satisfaction: float|int, etoiles: float}
     */
    public function getStatsParVet(int $vetId): array
    {
        $result = $this->createQueryBuilder('r')
            ->select('AVG(r.note) as noteMoyenne, COUNT(r.id) as nombreAvis')
            ->where('r.vet = :vetId')
            ->setParameter('vetId', $vetId)
            ->getQuery()
            ->getSingleResult();

        $noteMoyenne = round((float)($result['noteMoyenne'] ?? 0), 1);

        return [
            'note_moyenne'      => $noteMoyenne,
            'nombre_avis'       => (int)$result['nombreAvis'],
            'taux_satisfaction' => $noteMoyenne > 0 ? round(($noteMoyenne / 5) * 100) : 0,
            'etoiles'           => round($noteMoyenne), // pour affichage ⭐
        ];
    }

    /**
     * @return list<array{vetId: int|string|null, noteMoyenne: string|null, nombreAvis: int|string}>
     */
    public function getStatsToutes(): array
    {
        $rows = $this->createQueryBuilder('r')
            ->select('IDENTITY(r.vet) as vetId, AVG(r.note) as noteMoyenne, COUNT(r.id) as nombreAvis')
            ->groupBy('r.vet')
            ->getQuery()
            ->getArrayResult();

        $stats = [];
        foreach ($rows as $row) {
            $stats[] = [
                'vetId' => $row['vetId'] ?? null,
                'noteMoyenne' => isset($row['noteMoyenne']) ? (string) $row['noteMoyenne'] : null,
                'nombreAvis' => (string) ($row['nombreAvis'] ?? 0),
            ];
        }

        return $stats;
    }
}
