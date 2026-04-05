<?php

namespace App\Twig;

use App\Service\HotelApiService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class HotelApiExtension extends AbstractExtension
{
    public function __construct(
        private HotelApiService $hotelApiService
    ) {}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('hotelApiService', [$this, 'getService']),
        ];
    }

    public function getService(): HotelApiService
    {
        return $this->hotelApiService;
    }
}