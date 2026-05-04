<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Shopges\PromoCode;
use App\Repository\Shopges\PromoCodeRepository;
use App\Service\Shopges\PromoCodeService;
use App\Tests\Support\EntityIdTrait;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

final class PromoCodeServiceTest extends TestCase
{
    use EntityIdTrait;

    public function testCalculateSummaryAppliesActiveDiscount(): void
    {
        $service = new PromoCodeService($this->createMock(PromoCodeRepository::class), $this->createMock(EntityManagerInterface::class));
        $promo = (new PromoCode())
            ->setCode('save10')
            ->setDiscountPercentage(10)
            ->setMaxUses(3)
            ->setExpiresAt(new \DateTimeImmutable('+1 day'));

        $summary = $service->calculateSummary(120.0, $promo);

        self::assertSame(120.0, $summary['subtotal']);
        self::assertSame(10.0, $summary['discount_percentage']);
        self::assertSame(12.0, $summary['discount_amount']);
        self::assertSame(108.0, $summary['total']);
        self::assertSame($promo, $summary['promo']);
    }

    public function testExpiredOrFullyUsedPromoIsIgnored(): void
    {
        $service = new PromoCodeService($this->createMock(PromoCodeRepository::class), $this->createMock(EntityManagerInterface::class));
        $promo = (new PromoCode())
            ->setDiscountPercentage(50)
            ->setMaxUses(1)
            ->setUsedCount(1)
            ->setExpiresAt(new \DateTimeImmutable('+1 day'));

        $summary = $service->calculateSummary(80.0, $promo);

        self::assertNull($summary['promo']);
        self::assertSame(0.0, $summary['discount_amount']);
        self::assertSame(80.0, $summary['total']);
    }

    public function testApplyAndMarkPromoUsedThroughSession(): void
    {
        $session = new Session(new MockArraySessionStorage());
        $promo = (new PromoCode())
            ->setCode('FUR-DEAL')
            ->setDiscountPercentage(20)
            ->setMaxUses(2)
            ->setExpiresAt(new \DateTimeImmutable('+1 day'));
        self::setEntityId($promo, 44);

        $repository = $this->createMock(PromoCodeRepository::class);
        $repository->expects(self::once())
            ->method('findActiveByCode')
            ->with('FUR-DEAL')
            ->willReturn($promo);
        $repository->method('find')->with(44)->willReturn($promo);

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects(self::once())->method('flush');

        $service = new PromoCodeService($repository, $entityManager);

        self::assertSame($promo, $service->applyCode($session, ' fur-deal ', 50));
        self::assertSame($promo, $service->getAppliedPromo($session));

        $service->markAppliedPromoUsed($session);

        self::assertSame(1, $promo->getUsedCount());
        self::assertNull($service->getAppliedPromo($session));
    }
}
