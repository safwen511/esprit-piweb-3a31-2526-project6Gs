<?php

declare(strict_types=1);

namespace App\Repository\Shopges;

use App\Entity\Shopges\PromoCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PromoCode>
 */
class PromoCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PromoCode::class);
    }

    public function findActiveByCode(string $code, ?\DateTimeImmutable $now = null): ?PromoCode
    {
        $promo = $this->createQueryBuilder('promo')
            ->andWhere('promo.code = :code')
            ->setParameter('code', strtoupper(trim($code)))
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        if (!$promo instanceof PromoCode) {
            return null;
        }

        if ($promo->isUsed() || $promo->isExpired($now)) {
            return null;
        }

        return $promo;
    }
}


