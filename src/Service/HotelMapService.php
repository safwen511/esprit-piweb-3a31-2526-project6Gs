<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\HotelRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class HotelMapService
{
    /**
     * Approximate hotel marker anchors used when an exact coordinate pair is missing.
     *
     * @var array<string, array{latitude: float, longitude: float}>
     */
    private const CITY_PINGS = [
        'tunis' => ['latitude' => 36.8065, 'longitude' => 10.1815],
        'ariana' => ['latitude' => 36.8665, 'longitude' => 10.1647],
        'la marsa' => ['latitude' => 36.8782, 'longitude' => 10.3247],
        'hammamet' => ['latitude' => 36.4000, 'longitude' => 10.6167],
        'nabeul' => ['latitude' => 36.4561, 'longitude' => 10.7376],
        'sousse' => ['latitude' => 35.8256, 'longitude' => 10.6084],
        'monastir' => ['latitude' => 35.7770, 'longitude' => 10.8262],
        'mahdia' => ['latitude' => 35.5047, 'longitude' => 11.0622],
        'sfax' => ['latitude' => 34.7406, 'longitude' => 10.7603],
        'kairouan' => ['latitude' => 35.6781, 'longitude' => 10.0963],
        'bizerte' => ['latitude' => 37.2744, 'longitude' => 9.8739],
        'gabes' => ['latitude' => 33.8815, 'longitude' => 10.0982],
        'gafsa' => ['latitude' => 34.4250, 'longitude' => 8.7842],
        'tozeur' => ['latitude' => 33.9197, 'longitude' => 8.1335],
        'djerba' => ['latitude' => 33.8076, 'longitude' => 10.8451],
    ];

    public function __construct(
        private readonly HotelRepository $hotelRepository,
        private readonly UrlGeneratorInterface $urlGenerator,
    ) {
    }

    /**
     * @return array{count: int, hotels: list<array{id: int, name: string, address: string, latitude: float, longitude: float, bookingUrl: string}>}
     */
    public function getHotelLocations(): array
    {
        $hotels = [];

        foreach ($this->hotelRepository->findAllOrdered() as $hotel) {
            $hotelId = $hotel->getId();

            if ($hotelId === null) {
                continue;
            }

            $ping = $this->resolvePingCoordinates(
                $hotel->getLatitude(),
                $hotel->getLongitude(),
                (string) $hotel->getName(),
                (string) $hotel->getAddress(),
            );

            $hotels[] = [
                'id' => $hotelId,
                'name' => (string) $hotel->getName(),
                'address' => (string) $hotel->getAddress(),
                'latitude' => $ping['latitude'],
                'longitude' => $ping['longitude'],
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

    /**
     * Builds a simple map ping position for a hotel.
     *
     * Exact coordinates are preferred. When they are missing, the hotel address
     * is matched against a small city list and falls back to a deterministic
     * offset so the existing hotel map can still render a pin.
     *
     * @return array{latitude: float, longitude: float}
     */
    public function resolvePingCoordinates(?float $latitude, ?float $longitude, string $hotelName, string $hotelAddress): array
    {
        if ($this->hasExactCoordinates($latitude, $longitude)) {
            return [
                'latitude' => round((float) $latitude, 6),
                'longitude' => round((float) $longitude, 6),
            ];
        }

        $locationText = mb_strtolower(trim($hotelName . ' ' . $hotelAddress));

        foreach (self::CITY_PINGS as $city => $ping) {
            if (str_contains($locationText, $city)) {
                return $ping;
            }
        }

        return $this->buildStableFallbackPing($locationText);
    }

    private function hasExactCoordinates(?float $latitude, ?float $longitude): bool
    {
        return $latitude !== null
            && $longitude !== null
            && $latitude >= -90
            && $latitude <= 90
            && $longitude >= -180
            && $longitude <= 180;
    }

    /**
     * @return array{latitude: float, longitude: float}
     */
    private function buildStableFallbackPing(string $seed): array
    {
        $hash = (int) sprintf('%u', crc32($seed !== '' ? $seed : 'hotel-map'));
        $latitudeOffset = (($hash % 1201) - 600) / 10000;
        $longitudeOffset = ((((int) floor($hash / 1201)) % 1601) - 800) / 10000;

        return [
            'latitude' => round(self::CITY_PINGS['tunis']['latitude'] + $latitudeOffset, 6),
            'longitude' => round(self::CITY_PINGS['tunis']['longitude'] + $longitudeOffset, 6),
        ];
    }
}
