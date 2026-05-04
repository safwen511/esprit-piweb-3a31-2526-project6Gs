<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Hotel;
use App\Service\HotelApiService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

final class HotelApiServiceTest extends TestCase
{
    public function testApiRatingAndPriceOverrideFallbacks(): void
    {
        $service = new HotelApiService(new MockHttpClient([
            new MockResponse(json_encode([['rating' => 4.64, 'price' => 133.456]], JSON_THROW_ON_ERROR)),
        ]));

        $details = $service->getHotelDetails('Fur Palace');

        self::assertSame(4.6, $details['rating']);
        self::assertSame(133.46, $details['price']);
        self::assertStringStartsWith('https://images.unsplash.com/', $details['image']);
    }

    public function testBlankHotelNameUsesStableFallbackDetails(): void
    {
        $service = new HotelApiService(new MockHttpClient());

        $first = $service->getHotelDetails('  ');
        $second = $service->getHotelDetails('  ');

        self::assertSame($first, $second);
        self::assertGreaterThanOrEqual(3.8, $first['rating']);
        self::assertGreaterThanOrEqual(79.0, $first['price']);
    }

    public function testBuildHotelCardsPreservesHotelInstances(): void
    {
        $hotel = (new Hotel())->setName('Card Hotel')->setAddress('Tunis');
        $service = new HotelApiService(new MockHttpClient([
            new MockResponse('[]'),
        ]));

        $cards = $service->buildHotelCards([$hotel]);

        self::assertSame($hotel, $cards[0]['hotel']);
        self::assertArrayHasKey('details', $cards[0]);
    }
}
