<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Service\HotelMapService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class HotelMapController extends AbstractController
{
    #[Route('/api/hotels', name: 'api_hotels', methods: ['GET'])]
    public function __invoke(HotelMapService $hotelMapService): JsonResponse
    {
        return $this->json($hotelMapService->getHotelLocations());
    }
}
