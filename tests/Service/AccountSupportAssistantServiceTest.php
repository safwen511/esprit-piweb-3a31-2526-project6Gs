<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\User;
use App\Service\AccountSupportAssistantService;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AccountSupportAssistantServiceTest extends TestCase
{
    public function testAnswerQuestionFallsBackWithoutApiKeys(): void
    {
        $httpClient = $this->createMock(HttpClientInterface::class);
        $service = new AccountSupportAssistantService($httpClient, '', '', '', '');

        $response = $service->answerQuestion('I think I used the wrong password for my blocked account', 'en');

        self::assertTrue($response['resolved']);
        self::assertStringContainsString('password reset', $response['answer']);
    }

    public function testEvaluateUnblockAppealFallsBackWithoutApiKeys(): void
    {
        $httpClient = $this->createMock(HttpClientInterface::class);
        $service = new AccountSupportAssistantService($httpClient, '', '', '', '');

        $user = (new User())
            ->setFirstName('Demo')
            ->setLastName('User')
            ->setEmail('demo@example.com')
            ->setPassword('strongpass123')
            ->setIsActive(false);

        $decision = $service->evaluateUnblockAppeal(
            $user,
            'I am sorry, this was a mistake, I understand the rules and it will not happen again. Please review my account.',
            'en'
        );

        self::assertTrue($decision['approved']);
        self::assertFalse($decision['escalate']);
        self::assertGreaterThanOrEqual(0.72, $decision['confidence']);
    }
}
