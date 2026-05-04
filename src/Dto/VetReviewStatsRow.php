<?php

declare(strict_types=1);

namespace App\Dto;

final class VetReviewStatsRow
{
    public function __construct(
        public readonly int $vetId,
        public readonly float $noteMoyenne,
        public readonly int $nombreAvis,
    ) {
    }
}
