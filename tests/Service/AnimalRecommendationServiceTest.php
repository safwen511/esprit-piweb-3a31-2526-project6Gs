<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Animal;
use App\Service\AnimalRecommendationService;
use PHPUnit\Framework\TestCase;

final class AnimalRecommendationServiceTest extends TestCase
{
    public function testAdoptionRecommendationPrioritizesMatchingAvailableAnimal(): void
    {
        $cat = (new Animal())
            ->setName('Luna')
            ->setType('Cat')
            ->setAge(8)
            ->setGender('FEMALE')
            ->setDescription('Calm and friendly with children')
            ->setStatus('AVAILABLE');

        $dog = (new Animal())
            ->setName('Rex')
            ->setType('Dog')
            ->setAge(60)
            ->setGender('MALE')
            ->setDescription('Energetic dog')
            ->setStatus('AVAILABLE');

        $recommendations = (new AnimalRecommendationService())->recommend(
            [$dog, $cat],
            'cat',
            'baby',
            'female',
            'calm friendly',
            [],
            2,
        );

        self::assertSame($cat, $recommendations[0]['animal']);
        self::assertGreaterThan($recommendations[1]['score'], $recommendations[0]['score']);
    }

    public function testAdoptionRecommendationIgnoresUnavailableAnimals(): void
    {
        $animal = (new Animal())
            ->setName('Milo')
            ->setType('Cat')
            ->setStatus('ADOPTED');

        $recommendations = (new AnimalRecommendationService())->recommend([$animal], 'cat', null, null, null);

        self::assertSame([], $recommendations);
    }
}
