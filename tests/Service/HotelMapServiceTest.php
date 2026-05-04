<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Hotel;
use App\Repository\HotelRepository;
use App\Service\HotelMapService;
use App\Tests\Support\EntityIdTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class HotelMapServiceTest extends TestCase
{
    use EntityIdTrait;

    public function testExactCoordinatesArePreferred(): void
    {
        $service = new HotelMapService($this->createMock(HotelRepository::class), $this->createMock(UrlGeneratorInterface::class));

        $ping = $service->resolvePingCoordinates(36.81234567, 10.19876543, 'Central Hotel', 'Tunis');

        self::assertSame(['latitude' => 36.812346, 'longitude' => 10.198765], $ping);
    }

    public function testKnownCityAddressProvidesFallbackCoordinates(): void
    {
        $service = new HotelMapService($this->createMock(HotelRepository::class), $this->createMock(UrlGeneratorInterface::class));

        $ping = $service->resolvePingCoordinates(null, null, 'Sea Stay', 'Avenue Habib Bourguiba, Sousse');

        self::assertSame(['latitude' => 35.8256, 'longitude' => 10.6084], $ping);
    }

    public function testHotelLocationsSkipUnpersistedHotelsAndGenerateBookingUrl(): void
    {
        $persisted = (new Hotel())->setName('Pet Hotel')->setAddress('Tunis')->setLatitude(null)->setLongitude(null);
        self::setEntityId($persisted, 9);
        $unpersisted = (new Hotel())->setName('Draft')->setAddress('Sfax');

        $repository = $this->createMock(HotelRepository::class);
        $repository->method('findAllOrdered')->willReturn([$persisted, $unpersisted]);

        $urls = $this->createMock(UrlGeneratorInterface::class);
        $urls->expects(self::once())
            ->method('generate')
            ->with('app_hotel_user_book', ['id' => 9])
            ->willReturn('/hotel/9/book');

        $locations = (new HotelMapService($repository, $urls))->getHotelLocations();

        self::assertSame(1, $locations['count']);
        self::assertSame('/hotel/9/book', $locations['hotels'][0]['bookingUrl']);
    }
}
