<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\HotelRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class HotelMapService
{
    public function __construct(
        private readonly HotelRepository $hotelRepository,
        private readonly UrlGeneratorInterface $urlGenerator,
    ) {
    }

    /**
     * @return array{count: int, hotels: list<array{id: int, name: string, address: string, latitude: ?float, longitude: ?float, bookingUrl: string}>}
     */
    public function getHotelLocations(): array
    {
        $hotels = [];

        foreach ($this->hotelRepository->findAllOrdered() as $hotel) {
            $hotelId = $hotel->getId();

            if ($hotelId === null) {
                continue;
            }

            $hotels[] = [
                'id' => $hotelId,
                'name' => (string) $hotel->getName(),
                'address' => (string) $hotel->getAddress(),
                'latitude' => $hotel->getLatitude(),
                'longitude' => $hotel->getLongitude(),
                'bookingUrl' => $this->urlGenerator->generate('app_hotel_user_book', [
                    'id' => $hotelId,
                ]),
            ];
        }

        return [
            'count' => count($hotels),
            'hotels' => $hotels,
        ];
    }
}
