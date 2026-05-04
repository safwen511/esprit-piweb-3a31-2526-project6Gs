<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\SocialFeedTriviaService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

final class SocialFeedTriviaServiceTest extends TestCase
{
    public function testFetchAnimalFactUsesFirstSuccessfulFactAndImage(): void
    {
        $client = new MockHttpClient([
            new MockResponse(json_encode(['fact' => 'Cats sleep a lot.'], JSON_THROW_ON_ERROR)),
            new MockResponse(json_encode(['file' => 'https://example.test/cat.jpg'], JSON_THROW_ON_ERROR)),
        ]);

        $fact = (new SocialFeedTriviaService($client))->fetchAnimalFact();

        self::assertSame('Cats sleep a lot.', $fact['fact']);
        self::assertSame('CatFact', $fact['source']);
        self::assertSame('https://example.test/cat.jpg', $fact['image']);
    }

    public function testFetchJokeCombinesSetupAndPunchlineFallbackEndpoint(): void
    {
        $client = new MockHttpClient([
            new MockResponse('{}', ['http_code' => 500]),
            new MockResponse(json_encode(['setup' => 'Why?', 'punchline' => 'Because.'], JSON_THROW_ON_ERROR)),
        ]);

        $joke = (new SocialFeedTriviaService($client))->fetchJoke();

        self::assertSame('Why? Because.', $joke['joke']);
        self::assertSame('Official Joke API', $joke['source']);
    }

    public function testFetchAnimalFactFallsBackWhenApisFail(): void
    {
        $client = new MockHttpClient([
            new MockResponse('{}', ['http_code' => 500]),
            new MockResponse('{}', ['http_code' => 500]),
            new MockResponse('{}', ['http_code' => 500]),
        ]);

        $fact = (new SocialFeedTriviaService($client))->fetchAnimalFact();

        self::assertSame('Local fallback', $fact['source']);
        self::assertNotSame('', $fact['fact']);
        self::assertSame('https://placekitten.com/400/240', $fact['image']);
    }
}
