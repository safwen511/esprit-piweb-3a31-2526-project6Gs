<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\Shopges\ShopCurrencyService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

final class ShopCurrencyServiceTest extends TestCase
{
    public function testSelectedCurrencyIsNormalizedAndInvalidValuesFallback(): void
    {
        $service = new ShopCurrencyService(new MockHttpClient());
        $session = new Session(new MockArraySessionStorage());

        $service->setSelectedCurrency($session, ' eur ');
        self::assertSame('EUR', $service->getSelectedCurrency($session));

        $service->setSelectedCurrency($session, 'btc');
        self::assertSame('USD', $service->getSelectedCurrency($session));
    }

    public function testCurrencyContextUsesRemoteRateWhenAvailable(): void
    {
        $client = new MockHttpClient([
            new MockResponse(json_encode(['rates' => ['EUR' => 0.301]], JSON_THROW_ON_ERROR)),
            new MockResponse(json_encode(['rates' => ['EUR' => 0.301]], JSON_THROW_ON_ERROR)),
        ]);
        $service = new ShopCurrencyService($client);
        $session = new Session(new MockArraySessionStorage());

        $service->setSelectedCurrency($session, 'EUR');
        $context = $service->getCurrencyContext($session);

        self::assertSame('EUR', $context['code']);
        self::assertSame(0.301, $context['rate']);
        self::assertSame('EUR 30.10', $service->formatAmount($service->convertFromBase(100, 'EUR'), 'EUR'));
    }

    public function testConversionFallsBackWhenRateCannotBeFetched(): void
    {
        $service = new ShopCurrencyService(new MockHttpClient([
            new MockResponse('{}', ['http_code' => 500]),
        ]));

        self::assertSame(32.0, $service->convertFromBase(100, 'USD'));
        self::assertSame('usd', $service->getStripeCurrency('USD'));
    }
}
