<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class HotelApiService
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getHotelDetails(string $hotelName): array
    {
        try {
            $response = $this->httpClient->request(
                'GET',
                'https://api.api-ninjas.com/v1/hotels',
                [
                    'query' => [
                        'name' => $hotelName,
                        'limit' => 1,
                    ],
                    'headers' => [
                        'X-Api-Key' => 'demo',
                    ],
                ]
            );

            $data = $response->toArray();

            if (!empty($data)) {
                $hotel = $data[0];
                return [
                    'rating' => $hotel['rating'] ?? 4.5,
                    'price' => $hotel['price'] ?? rand(50, 200),
                    'image' => $this->getHotelImage($hotelName),
                ];
            }
        } catch (\Exception $e) {
        }

        return [
            'rating' => 4.5,
            'price' => rand(50, 200),
            'image' => $this->getHotelImage($hotelName),
        ];
    }

    private function getHotelImage(string $hotelName): string
    {
        $images = [
            'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=350&fit=crop',
            'https://images.unsplash.com/photo-1582719508461-905c673771fd?w=400&h=350&fit=crop',
            'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=400&h=350&fit=crop',
            'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=400&h=350&fit=crop',
            'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=400&h=350&fit=crop',
        ];

        $hash = crc32($hotelName);
        return $images[$hash % count($images)];
    }

    public function getAllHotelsDetails(array $hotels): array
    {
        $result = [];
        foreach ($hotels as $hotel) {
            $result[] = [
                'id' => $hotel->getId(),
                'name' => $hotel->getName(),
                'address' => $hotel->getAddress(),
                'capacity' => $hotel->getCapacity(),
                'pricePerNight' => $hotel->getPricePerNight(),
                'apiData' => $this->getHotelDetails($hotel->getName()),
            ];
        }
        return $result;
    }
}