<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Hotel;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class HotelApiService
{
    private const IMAGE_SET = [
        'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1200&q=80',
    ];

    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {
    }

    /**
     * @return array{rating: float, price: float, image: string}
     */
    public function getHotelDetails(string $hotelName): array
    {
        $hotelName = trim($hotelName);
        $fallback = [
            'rating' => $this->getFallbackRating($hotelName),
            'price' => $this->getFallbackPrice($hotelName),
            'image' => $this->getHotelImage($hotelName),
        ];

        if ($hotelName === '') {
            return $fallback;
        }

        try {
            $response = $this->httpClient->request('GET', 'https://api.api-ninjas.com/v1/hotels', [
                'query' => [
                    'name' => $hotelName,
                    'limit' => 1,
                ],
                'headers' => [
                    'X-Api-Key' => 'demo',
                ],
            ]);

            $payload = $response->toArray(false);

            if (isset($payload[0]) && is_array($payload[0])) {
                $hotel = $payload[0];

                return [
                    'rating' => isset($hotel['rating']) && is_numeric($hotel['rating']) ? round((float) $hotel['rating'], 1) : $fallback['rating'],
                    'price' => isset($hotel['price']) && is_numeric($hotel['price']) ? round((float) $hotel['price'], 2) : $fallback['price'],
                    'image' => $fallback['image'],
                ];
            }
        } catch (\Throwable) {
        }

        return $fallback;
    }

    /**
     * @param Hotel[] $hotels
     *
     * @return list<array{hotel: Hotel, details: array{rating: float, price: float, image: string}}>
     */
    public function buildHotelCards(array $hotels): array
    {
        $cards = [];

        foreach ($hotels as $hotel) {
            $cards[] = [
                'hotel' => $hotel,
                'details' => $this->getHotelDetails((string) $hotel->getName()),
            ];
        }

        return $cards;
    }

    private function getHotelImage(string $hotelName): string
    {
        return self::IMAGE_SET[$this->getStableHash($hotelName) % count(self::IMAGE_SET)];
    }

    private function getFallbackPrice(string $hotelName): float
    {
        return (float) (79 + ($this->getStableHash($hotelName) % 121));
    }

    private function getFallbackRating(string $hotelName): float
    {
        return round(min(5.0, 3.8 + (($this->getStableHash($hotelName) % 12) / 10)), 1);
    }

    private function getStableHash(string $value): int
    {
        return (int) sprintf('%u', crc32(mb_strtolower(trim($value))));
    }
}
