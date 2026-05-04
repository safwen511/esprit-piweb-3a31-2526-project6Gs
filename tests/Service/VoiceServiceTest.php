<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Exception\VoiceServiceException;
use App\Service\VoiceService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

final class VoiceServiceTest extends TestCase
{
    public function testRemoteUnavailableServiceFailsBeforeAutoBoot(): void
    {
        $audioPath = tempnam(sys_get_temp_dir(), 'voice-');
        self::assertIsString($audioPath);
        file_put_contents($audioPath, 'audio');

        $service = new VoiceService(
            new MockHttpClient([new MockResponse('{}', ['http_code' => 503])]),
            sys_get_temp_dir(),
            'https://voice.example.test'
        );

        $this->expectException(VoiceServiceException::class);
        $this->expectExceptionMessage('configured voice service is unavailable');

        $service->enroll($audioPath);
    }
}
