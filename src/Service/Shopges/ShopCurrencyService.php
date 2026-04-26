<?php

declare(strict_types=1);

namespace App\Service\Shopges;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class ShopCurrencyService
{
    private const SESSION_KEY = 'shop.payment_currency';
    private const BASE_CURRENCY = 'TND';
    private const FALLBACK_RATES = [
        'USD' => 0.32,
        'EUR' => 0.30,
        'GBP' => 0.26,
    ];
    private const SUPPORTED = [
        'USD' => ['label' => 'US Dollar', 'symbol' => '$', 'stripe' => 'usd'],
        'EUR' => ['label' => 'Euro', 'symbol' => 'EUR'],
        'GBP' => ['label' => 'British Pound', 'symbol' => 'GBP'],
    ];

    public function __construct(private readonly HttpClientInterface $httpClient)
    {
    }

    /**
     * @return array<string, array{label:string,symbol:string,stripe?:string}>
     */
    public function getAvailableCurrencies(): array
    {
        return self::SUPPORTED;
    }

    public function getSelectedCurrency(SessionInterface $session): string
    {
        $selected = strtoupper((string) $session->get(self::SESSION_KEY, 'USD'));

        return array_key_exists($selected, self::SUPPORTED) ? $selected : 'USD';
    }

    public function setSelectedCurrency(SessionInterface $session, string $currency): void
    {
        $normalized = strtoupper(trim($currency));
        $session->set(self::SESSION_KEY, array_key_exists($normalized, self::SUPPORTED) ? $normalized : 'USD');
    }

    /**
     * @return array{code:string,label:string,symbol:string,rate:float,base:string}
     */
    public function getCurrencyContext(SessionInterface $session): array
    {
        $code = $this->getSelectedCurrency($session);
        $definition = self::SUPPORTED[$code];

        return [
            'code' => $code,
            'label' => $definition['label'],
            'symbol' => $definition['symbol'],
            'rate' => $this->getExchangeRate($code),
            'base' => self::BASE_CURRENCY,
        ];
    }

    public function convertFromBase(float $amount, string $currencyCode): float
    {
        return round(max(0.0, $amount) * $this->getExchangeRate($currencyCode), 2);
    }

    public function formatAmount(float $amount, string $currencyCode): string
    {
        $currencyCode = strtoupper($currencyCode);
        $definition = self::SUPPORTED[$currencyCode] ?? ['symbol' => $currencyCode];

        return trim($definition['symbol'].' '.number_format($amount, 2, '.', ' '));
    }

    public function getStripeCurrency(string $currencyCode): string
    {
        $definition = self::SUPPORTED[strtoupper($currencyCode)] ?? null;

        return strtolower((string) ($definition['stripe'] ?? strtoupper($currencyCode)));
    }

    private function getExchangeRate(string $currencyCode): float
    {
        $currencyCode = strtoupper($currencyCode);
        if ($currencyCode === self::BASE_CURRENCY) {
            return 1.0;
        }

        try {
            $response = $this->httpClient->request('GET', sprintf('https://open.er-api.com/v6/latest/%s', self::BASE_CURRENCY), [
                'timeout' => 5,
            ]);
            $payload = $response->toArray(false);
            $rate = $payload['rates'][$currencyCode] ?? null;

            if (is_numeric($rate) && (float) $rate > 0) {
                return (float) $rate;
            }
        } catch (\Throwable) {
        }

        return self::FALLBACK_RATES[$currencyCode] ?? 1.0;
    }
}

