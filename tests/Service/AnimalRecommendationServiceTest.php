<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Animal;
use App\Service\AnimalRecommendationService;
use PHPUnit\Framework\TestCase;

final class AnimalRecommendationServiceTest extends TestCase
{
    private AnimalRecommendationService $service;

    protected function setUp(): void
    {
        $this->service = new AnimalRecommendationService();
    }

    public function testRecommendsAnimalMatchingAllPreferences(): void
    {
        $luna = $this->animal(
            name: 'Luna',
            type: 'Dog',
            age: 8,
            gender: 'FEMALE',
            status: 'AVAILABLE',
            description: 'Calm and playful companion',
            breed: 'Mixed',
        );

        $results = $this->service->recommend([$luna], 'dog', 'baby', 'female', 'calm playful');

        self::assertCount(1, $results);
        self::assertSame($luna, $results[0]['animal']);
        self::assertSame(90, $results[0]['score']);
        self::assertSame([
            'Matches your preferred species.',
            'Matches your preferred age group.',
            'Matches your preferred gender.',
            'Description matches your preferred temperament traits.',
        ], $results[0]['reasons']);
    }

    public function testIgnoresUnavailableAnimals(): void
    {
        $available = $this->animal('Milo', 'Cat', 18, 'MALE', 'AVAILABLE');
        $adopted = $this->animal('Rocky', 'Dog', 12, 'MALE', 'ADOPTED');
        $unavailable = $this->animal('Nala', 'Dog', 10, 'FEMALE', 'UNAVAILABLE');

        $results = $this->service->recommend([$available, $adopted, $unavailable], null, null, null, null);

        self::assertCount(1, $results);
        self::assertSame($available, $results[0]['animal']);
    }

    public function testSortsRecommendationsByHighestScore(): void
    {
        $strongMatch = $this->animal('Bella', 'Dog', 9, 'FEMALE', 'AVAILABLE', 'Calm loyal dog');
        $weakMatch = $this->animal('Simba', 'Cat', 72, 'MALE', 'AVAILABLE', 'Independent cat');

        $results = $this->service->recommend([$weakMatch, $strongMatch], 'dog', 'baby', 'female', 'calm loyal');

        self::assertSame($strongMatch, $results[0]['animal']);
        self::assertGreaterThan($results[1]['score'], $results[0]['score']);
    }

    public function testRespectsLimitButReturnsAtLeastOneAnimal(): void
    {
        $animals = [
            $this->animal('Aki', 'Dog', 6, 'MALE', 'AVAILABLE'),
            $this->animal('Ruby', 'Cat', 24, 'FEMALE', 'AVAILABLE'),
            $this->animal('Oscar', 'Rabbit', 14, 'MALE', 'AVAILABLE'),
        ];

        $limitedResults = $this->service->recommend($animals, null, null, null, null, limit: 2);
        $minimumResults = $this->service->recommend($animals, null, null, null, null, limit: 0);

        self::assertCount(2, $limitedResults);
        self::assertCount(1, $minimumResults);
    }

    public function testAddsFallbackReasonWhenNoPreferenceMatches(): void
    {
        $animal = $this->animal('Coco', 'Bird', 48, 'FEMALE', 'AVAILABLE', 'Quiet bird');

        $results = $this->service->recommend([$animal], 'dog', 'baby', 'male', 'playful');

        self::assertSame(0, $results[0]['score']);
        self::assertSame([
            'Closest match based on currently available profile data.',
        ], $results[0]['reasons']);
    }

    public function testIgnoresTraitKeywordsShorterThanThreeCharacters(): void
    {
        $animal = $this->animal('Tiny', 'Hamster', 5, 'MALE', 'AVAILABLE', 'Go ox');

        $results = $this->service->recommend([$animal], null, null, null, 'go ox');

        self::assertSame(0, $results[0]['score']);
        self::assertNotContains(
            'Description matches your preferred temperament traits.',
            $results[0]['reasons'],
        );
    }

    private function animal(
        string $name,
        string $type,
        int $age,
        string $gender,
        string $status,
        ?string $description = null,
        ?string $breed = null,
    ): Animal {
        return (new Animal())
            ->setName($name)
            ->setType($type)
            ->setAge($age)
            ->setGender($gender)
            ->setStatus($status)
            ->setDescription($description)
            ->setBreed($breed);
    }
}
