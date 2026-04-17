<?php
// src/Repository/ReviewRepository.php
namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

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

    public function getStatsToutes(): array
    {
        return $this->createQueryBuilder('r')
            ->select('IDENTITY(r.vet) as vetId, AVG(r.note) as noteMoyenne, COUNT(r.id) as nombreAvis')
            ->groupBy('r.vet')
            ->getQuery()
            ->getArrayResult();
    }
}