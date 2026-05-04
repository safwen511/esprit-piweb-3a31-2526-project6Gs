<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\PetCareAssistantService;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class PetCareAssistantServiceTest extends TestCase
{
    public function testGreetingUsesRequestedLocaleFallback(): void
    {
        $service = new PetCareAssistantService($this->createMock(HttpClientInterface::class));

        $response = $service->answerQuestion('Bonjour', 'fr');

        self::assertTrue($response['in_scope']);
        self::assertStringContainsString('Bonjour', $response['answer']);
    }

    public function testToxicFoodQuestionReturnsUrgentPetCareAdvice(): void
    {
        $service = new PetCareAssistantService($this->createMock(HttpClientInterface::class));

        $response = $service->answerQuestion('Can my dog eat chocolate?', 'en');

        self::assertTrue($response['in_scope']);
        self::assertStringContainsString('Chocolate', $response['answer']);
        self::assertStringContainsString('veterinarian', $response['answer']);
    }

    public function testUnrelatedQuestionIsPolitelyOutOfScope(): void
    {
        $service = new PetCareAssistantService($this->createMock(HttpClientInterface::class));

        $response = $service->answerQuestion('How do I repair my laptop?', 'en');

        self::assertFalse($response['in_scope']);
        self::assertStringContainsString('vaccines', $response['answer']);
    }

    public function testBlankQuestionIsRejected(): void
    {
        $service = new PetCareAssistantService($this->createMock(HttpClientInterface::class));

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('pet_ai.validation.question_required');

        $service->answerQuestion('  ', 'en');
    }
}
