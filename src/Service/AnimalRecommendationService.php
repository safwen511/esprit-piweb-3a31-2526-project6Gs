<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Animal;

final class AnimalRecommendationService
{
    /**
     * @param Animal[] $animals
     * @param array<int, int> $requestCountByAnimalId
     * @return list<array{animal: Animal, score: int, reasons: string[]}>
     */
    public function recommend(
        array $animals,
        ?string $preferredType,
        ?string $preferredAgeBucket,
        ?string $preferredGender,
        ?string $preferredTraits,
        array $requestCountByAnimalId = [],
        int $limit = 6,
    ): array {
        $normalizedType = $this->normalize($preferredType);
        $normalizedAgeBucket = $this->normalize($preferredAgeBucket);
        $normalizedGender = $this->normalize($preferredGender);
        $traitKeywords = $this->extractTraitKeywords($preferredTraits);

        $maxRequests = 0;
        foreach ($requestCountByAnimalId as $count) {
            $maxRequests = max($maxRequests, $count);
        }

        $scored = [];

        foreach ($animals as $animal) {
            if (!$animal instanceof Animal) {
                continue;
            }

            if ($this->normalize($animal->getStatus()) !== 'available') {
                continue;
            }

            $score = 0;
            $reasons = [];

            if ($normalizedType !== null && $normalizedType === $this->normalize($animal->getType())) {
                $score += 35;
                $reasons[] = 'Matches your preferred species.';
            }

            $animalAgeBucket = $this->resolveAgeBucket($animal->getAge());
            if ($normalizedAgeBucket !== null && $animalAgeBucket !== null && $normalizedAgeBucket === $animalAgeBucket) {
                $score += 25;
                $reasons[] = 'Matches your preferred age group.';
            }

            if ($normalizedGender !== null && $normalizedGender === $this->normalize($animal->getGender())) {
                $score += 10;
                $reasons[] = 'Matches your preferred gender.';
            }

            if ($traitKeywords !== []) {
                $searchText = $this->normalize(implode(' ', [
                    (string) $animal->getDescription(),
                    (string) $animal->getBreed(),
                    (string) $animal->getType(),
                ])) ?? '';
                $matchedTraits = 0;

                foreach ($traitKeywords as $keyword) {
                    if (str_contains($searchText, $keyword)) {
                        ++$matchedTraits;
                    }
                }

                if ($matchedTraits > 0) {
                    $traitRatio = $matchedTraits / count($traitKeywords);
                    $score += (int) round(20 * $traitRatio);
                    $reasons[] = 'Description matches your preferred temperament traits.';
                }
            }

            $animalId = $animal->getId();
            $requests = $animalId !== null ? ($requestCountByAnimalId[$animalId] ?? 0) : 0;
            if ($maxRequests > 0 && $requests > 0) {
                $score += (int) round(($requests / $maxRequests) * 10);
                $reasons[] = 'Shows good adoption demand from previous requests.';
            }

            $score = min(100, $score);

            if ($reasons === []) {
                $reasons[] = 'Closest match based on currently available profile data.';
            }

            $scored[] = [
                'animal' => $animal,
                'score' => $score,
                'reasons' => array_values(array_unique($reasons)),
            ];
        }

        usort(
            $scored,
            static fn (array $left, array $right): int => $right['score'] <=> $left['score']
        );

        return array_slice($scored, 0, max(1, $limit));
    }

    private function normalize(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $trimmed = trim(mb_strtolower($value));

        return $trimmed !== '' ? $trimmed : null;
    }

    /**
     * @return list<string>
     */
    private function extractTraitKeywords(?string $traits): array
    {
        $normalized = $this->normalize($traits);
        if ($normalized === null) {
            return [];
        }

        $keywords = preg_split('/[\s,;|]+/', $normalized) ?: [];
        $keywords = array_filter($keywords, static fn (string $word): bool => mb_strlen($word) >= 3);

        return array_values(array_unique($keywords));
    }

    private function resolveAgeBucket(?int $ageInMonths): ?string
    {
        if ($ageInMonths === null || $ageInMonths < 0) {
            return null;
        }

        return match (true) {
            $ageInMonths <= 12 => 'baby',
            $ageInMonths <= 36 => 'young',
            $ageInMonths <= 96 => 'adult',
            default => 'senior',
        };
    }
}

