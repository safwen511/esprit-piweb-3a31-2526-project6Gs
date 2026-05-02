<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\AdoptionRequest;
use App\Entity\Animal;
use PHPUnit\Framework\TestCase;

final class AdoptionRequestTest extends TestCase
{
    public function testAdoptionRequestStoresAnimalClientAndStatus(): void
    {
        $animal = (new Animal())->setName('Luna')->setType('Cat');
        $date = new \DateTimeImmutable('2026-05-01 10:00:00');

        $request = (new AdoptionRequest())
            ->setAnimal($animal)
            ->setClientId(42)
            ->setRequestDate($date)
            ->setStatus('APPROVED');

        self::assertSame($animal, $request->getAnimal());
        self::assertSame(42, $request->getClientId());
        self::assertSame($date, $request->getRequestDate());
        self::assertSame('APPROVED', $request->getStatus());
    }
}
