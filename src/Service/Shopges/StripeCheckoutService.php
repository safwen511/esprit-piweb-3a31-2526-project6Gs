<?php

declare(strict_types=1);

namespace App\Service\Shopges;

use App\Entity\Shopges\Panier;
use Stripe\Checkout\Session;
use Stripe\StripeClient;

final class StripeCheckoutService
{
    public function __construct(
        private readonly string $stripeSecretKey,
        private readonly string $currency,
    ) {
    }

    /**
     * @param list<Panier> $cartItems
     * @param array{subtotal?:float,discount_amount?:float,total?:float}|null $pricing
     */
    public function createCheckoutSession(
        array $cartItems,
        string $successUrl,
        string $cancelUrl,
        string $currency,
        float $conversionRate,
        ?array $pricing = null,
    ): Session {
        $secretKey = trim($this->stripeSecretKey);
        if ($secretKey === '') {
            throw new \RuntimeException('Stripe secret key is not configured.');
        }

        if ($cartItems === []) {
            throw new \RuntimeException('Cannot create a Stripe checkout for an empty cart.');
        }

        $client = new StripeClient($secretKey);
        $discountAmount = isset($pricing['discount_amount']) ? (float) $pricing['discount_amount'] : 0.0;

        return $client->checkout->sessions->create([
            'mode' => 'payment',
            'success_url' => $successUrl,
            'cancel_url' => $cancelUrl,
            'line_items' => $this->buildLineItems($cartItems, $discountAmount, $currency, $conversionRate),
        ]);
    }

    /**
     * @param list<Panier> $cartItems
     * @return list<array<string,mixed>>
     */
    private function buildLineItems(array $cartItems, float $discountAmount, string $currency, float $conversionRate): array
    {
        $subtotalBase = 0.0;
        $lineTotals = [];

        foreach ($cartItems as $item) {
            $lineBase = max(0.0, (float) $item->getLineTotal());
            $lineTotals[] = $lineBase;
            $subtotalBase += $lineBase;
        }

        $discountBase = min(max(0.0, $discountAmount), $subtotalBase);
        $allocatedDiscount = 0.0;
        $lineItems = [];

        foreach ($cartItems as $index => $item) {
            $lineBase = $lineTotals[$index] ?? 0.0;
            $currentDiscount = 0.0;

            if ($discountBase > 0 && $subtotalBase > 0) {
                if ($index === array_key_last($cartItems)) {
                    $currentDiscount = max(0.0, $discountBase - $allocatedDiscount);
                } else {
                    $currentDiscount = round(($lineBase / $subtotalBase) * $discountBase, 2);
                    $allocatedDiscount += $currentDiscount;
                }
            }

            $discountedLineCents = max(1, (int) round(max(0.01, $lineBase - $currentDiscount) * max(0.0001, $conversionRate) * 100));
            $quantity = max(1, (int) $item->getQty());

            $description = trim(sprintf(
                'Qty: %d%s%s',
                $quantity,
                $item->getProduit()->getDescription() ? ' | ' : '',
                (string) ($item->getProduit()->getDescription() ?? '')
            ));

            $lineItems[] = [
                'quantity' => 1,
                'price_data' => [
                    'currency' => strtolower($currency !== '' ? $currency : $this->currency),
                    'unit_amount' => $discountedLineCents,
                    'product_data' => [
                        'name' => sprintf('%s x%d', (string) $item->getTitle(), $quantity),
                        'description' => $description,
                    ],
                ],
            ];
        }

        return $lineItems;
    }
}

