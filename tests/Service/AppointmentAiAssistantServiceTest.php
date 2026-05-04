<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\AppointmentAiAssistantService;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class AppointmentAiAssistantServiceTest extends TestCase
{
    public function testLocalSuggestionBuildsFrenchRdvSummary(): void
    {
        $service = new AppointmentAiAssistantService($this->createMock(HttpClientInterface::class));

        $result = $service->buildLocalSuggestion(
            'Il tousse depuis deux jours et mange moins.',
            'Rex',
            'chien',
            'fr',
        );

        self::assertStringContainsString('Rex (chien)', $result['suggested_note']);
        self::assertStringContainsString('Il tousse depuis deux jours', $result['intake_summary']);
        self::assertCount(3, $result['checklist']);
    }

    public function testEmptyRdvDescriptionIsRejected(): void
    {
        $service = new AppointmentAiAssistantService($this->createMock(HttpClientInterface::class));

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('appointments.ai.description_required');

        $service->assistBookingRequest('   ', 'Rex', 'dog', 'en');
    }
}
