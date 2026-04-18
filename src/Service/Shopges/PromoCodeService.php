<?php

declare(strict_types=1);

namespace App\Service\Shopges;

use App\Entity\Shopges\Produit;
use App\Entity\Shopges\PromoCode;
use App\Entity\User;
use App\Repository\Shopges\PromoCodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class PromoCodeService
{
    private const SESSION_KEY = 'shop.applied_promo_id';

    public function __construct(
        private readonly PromoCodeRepository $promoCodes,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @param list<User> $users
     */
    public function createSharedPromoCodeForProduct(array $users, Produit $product): PromoCode
    {
        $expiresAt = (new \DateTimeImmutable())->modify('+14 days');
        $promo = (new PromoCode())
            ->setProduct($product)
            ->setCode($this->generateUniqueCode())
            ->setDiscountPercentage($this->buildDiscountPercentage())
            ->setExpiresAt($expiresAt)
            ->setMaxUses(max(1, count($users)));

        $this->entityManager->persist($promo);
        $this->entityManager->flush();

        return $promo;
    }

    /**
     * @return array{subtotal:float,discount_percentage:?float,discount_amount:float,total:float,promo:?PromoCode}
     */
    public function calculateSummary(float $subtotal, ?PromoCode $promo = null): array
    {
        $subtotal = max(0.0, round($subtotal, 2));
        if ($subtotal <= 0.0 || !$promo instanceof PromoCode || $promo->isUsed() || $promo->isExpired()) {
            return [
                'subtotal' => $subtotal,
                'discount_percentage' => null,
                'discount_amount' => 0.0,
                'total' => $subtotal,
                'promo' => null,
            ];
        }

        $discountAmount = round($subtotal * ($promo->getDiscountPercentage() / 100), 2);
        $discountAmount = min($discountAmount, $subtotal);

        return [
            'subtotal' => $subtotal,
            'discount_percentage' => $promo->getDiscountPercentage(),
            'discount_amount' => $discountAmount,
            'total' => round($subtotal - $discountAmount, 2),
            'promo' => $promo,
        ];
    }

    public function applyCode(SessionInterface $session, string $code, float $subtotal): PromoCode
    {
        $normalized = strtoupper(trim($code));
        if ($normalized === '') {
            throw new \RuntimeException('Please enter a promo code.');
        }

        if ($subtotal <= 0.0) {
            throw new \RuntimeException('Add products to your cart before applying a promo code.');
        }

        $promo = $this->promoCodes->findActiveByCode($normalized, new \DateTimeImmutable());
        if (!$promo instanceof PromoCode) {
            throw new \RuntimeException('This promo code is invalid, expired, or no longer available.');
        }

        $session->set(self::SESSION_KEY, $promo->getId());

        return $promo;
    }

    public function clearAppliedCode(SessionInterface $session): void
    {
        $session->remove(self::SESSION_KEY);
    }

    public function getAppliedPromo(SessionInterface $session): ?PromoCode
    {
        $promoId = $session->get(self::SESSION_KEY);
        if (!is_int($promoId) && !ctype_digit((string) $promoId)) {
            return null;
        }

        $promo = $this->promoCodes->find((int) $promoId);
        if (
            !$promo instanceof PromoCode
            || $promo->isUsed()
            || $promo->isExpired(new \DateTimeImmutable())
        ) {
            $this->clearAppliedCode($session);

            return null;
        }

        return $promo;
    }

    public function markAppliedPromoUsed(SessionInterface $session): void
    {
        $promo = $this->getAppliedPromo($session);
        if (!$promo instanceof PromoCode) {
            return;
        }

        $promo->markUsed();
        $this->entityManager->flush();
        $this->clearAppliedCode($session);
    }

    private function buildDiscountPercentage(): float
    {
        return round(random_int(50, 300) / 10, 1);
    }

    private function generateUniqueCode(): string
    {
        do {
            $candidate = sprintf('FUR-%s-%s', strtoupper(bin2hex(random_bytes(3))), strtoupper(bin2hex(random_bytes(2))));
        } while ($this->promoCodes->findOneBy(['code' => $candidate]) instanceof PromoCode);

        return $candidate;
    }
}


