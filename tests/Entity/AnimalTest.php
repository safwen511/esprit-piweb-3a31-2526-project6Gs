<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Animal;
use PHPUnit\Framework\TestCase;

final class AnimalTest extends TestCase
{
    public function testFormattedAgeUsesMonthsForYoungAnimals(): void
    {
        $animal = (new Animal())->setAge(5);

        self::assertSame('5 months', $animal->getFormattedAge());
        self::assertSame(5, $animal->getAgeValueInput());
        self::assertSame('months', $animal->getAgeUnitInput());
    }

    public function testFormattedAgeSplitsYearsAndMonths(): void
    {
        $animal = (new Animal())->setAge(29);

        self::assertSame('2 years 5 months', $animal->getFormattedAge());
        self::assertSame(29, $animal->getAgeValueInput());
        self::assertSame('months', $animal->getAgeUnitInput());
    }

    public function testExactYearAgeUsesYearInput(): void
    {
        $animal = (new Animal())->setAge(24);

        self::assertSame('2 years', $animal->getFormattedAge());
        self::assertSame(2, $animal->getAgeValueInput());
        self::assertSame('years', $animal->getAgeUnitInput());
    }
}
