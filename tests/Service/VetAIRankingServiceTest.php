<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\User;
use App\Service\VetAIRankingService;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class VetAIRankingServiceTest extends TestCase
{
    public function testFallbackRankingSortsByRatingReviewsAndSatisfaction(): void
    {
        $service = new VetAIRankingService($this->createMock(HttpClientInterface::class));

        $ranking = $service->getTop3([
            ['vet' => $this->vet('Amina', 'One'), 'stats' => ['note_moyenne' => 4.7, 'nombre_avis' => 4, 'taux_satisfaction' => 90]],
            ['vet' => $this->vet('Bilel', 'Two'), 'stats' => ['note_moyenne' => 4.9, 'nombre_avis' => 1, 'taux_satisfaction' => 80]],
            ['vet' => $this->vet('Carla', 'Three'), 'stats' => ['note_moyenne' => 4.7, 'nombre_avis' => 9, 'taux_satisfaction' => 95]],
            ['vet' => $this->vet('Dina', 'Four'), 'stats' => ['note_moyenne' => 3.5, 'nombre_avis' => 99, 'taux_satisfaction' => 100]],
        ]);

        self::assertSame('Dr. Bilel Two', $ranking['top3'][0]['nom']);
        self::assertSame('Dr. Carla Three', $ranking['top3'][1]['nom']);
        self::assertSame('Dr. Amina One', $ranking['top3'][2]['nom']);
    }

    public function testEmptyVetListReturnsEmptyRanking(): void
    {
        $service = new VetAIRankingService($this->createMock(HttpClientInterface::class));

        self::assertSame(['top3' => []], $service->getTop3([]));
    }

    private function vet(string $firstName, string $lastName): User
    {
        return (new User())
            ->setEmail(strtolower($firstName).'@example.com')
            ->setFirstName($firstName)
            ->setLastName($lastName);
    }
}
