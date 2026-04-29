<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class SocialFeedTriviaService
{
    public function __construct(private readonly HttpClientInterface $httpClient)
    {
    }

    /**
     * @return array{fact: string, source: string, image: string}
     */
    public function fetchAnimalFact(): array
    {
        $factEndpoints = [
            [
                'url' => 'https://catfact.ninja/fact',
                'source' => 'CatFact',
                'parser' => static fn (array $payload): ?string => $payload['fact'] ?? null,
            ],
            [
                'url' => 'https://dog-api.kinduff.com/api/facts?number=1',
                'source' => 'Dog Facts API',
                'parser' => static fn (array $payload): ?string => $payload['facts'][0] ?? null,
            ],
            [
                'url' => 'https://some-random-api.ml/facts/bird',
                'source' => 'Some Random API',
                'parser' => static fn (array $payload): ?string => $payload['fact'] ?? null,
            ],
        ];

        foreach ($factEndpoints as $endpoint) {
            $fact = $this->fetchFact($endpoint['url'], $endpoint['parser']);

            if ($fact !== null) {
                return [
                    'fact' => $fact,
                    'source' => $endpoint['source'],
                    'image' => $this->fetchAnimalImage(),
                ];
            }
        }

        return [
            'fact' => $this->fetchFallbackAnimalFact(),
            'source' => 'Local fallback',
            'image' => $this->fetchFallbackAnimalImage(),
        ];
    }

    /**
     * @return array{joke: string, source: string}
     */
    public function fetchJoke(): array
    {
        $jokeEndpoints = [
            [
                'url' => 'https://v2.jokeapi.dev/joke/Any?type=single&lang=en',
                'source' => 'JokeAPI',
                'parser' => static fn (array $payload): ?string => $payload['joke'] ?? null,
            ],
            [
                'url' => 'https://official-joke-api.appspot.com/random_joke',
                'source' => 'Official Joke API',
                'parser' => static fn (array $payload): ?string => (isset($payload['setup'], $payload['punchline']) ? $payload['setup'] . ' ' . $payload['punchline'] : null),
            ],
            [
                'url' => 'https://icanhazdadjoke.com/',
                'source' => 'icanhazdadjoke',
                'parser' => static fn (array $payload): ?string => $payload['joke'] ?? null,
                'headers' => ['Accept' => 'application/json'],
            ],
        ];

        foreach ($jokeEndpoints as $endpoint) {
            $parser = $endpoint['parser'];
            $headers = $endpoint['headers'] ?? ['Accept' => 'application/json'];
            $joke = $this->fetchFact($endpoint['url'], $parser, $headers);

            if ($joke !== null) {
                return [
                    'joke' => $joke,
                    'source' => $endpoint['source'],
                ];
            }
        }

        return [
            'joke' => $this->fetchFallbackJoke(),
            'source' => 'Local fallback',
        ];
    }

    private function fetchAnimalImage(): string
    {
        $imageEndpoints = [
            [
                'url' => 'https://aws.random.cat/meow',
                'parser' => static fn (array $payload): ?string => $payload['file'] ?? null,
            ],
            [
                'url' => 'https://dog.ceo/api/breeds/image/random',
                'parser' => static fn (array $payload): ?string => $payload['message'] ?? null,
            ],
            [
                'url' => 'https://shibe.online/api/cats?count=1',
                'parser' => static fn (array $payload): ?string => $payload[0] ?? null,
            ],
        ];

        foreach ($imageEndpoints as $endpoint) {
            $image = $this->fetchFact($endpoint['url'], $endpoint['parser']);

            if ($image !== null) {
                return $image;
            }
        }

        return $this->fetchFallbackAnimalImage();
    }

    /**
     * @param callable(array<string, mixed>): ?string $parser
     * @param array<string, string> $headers
     */
    private function fetchFact(string $url, callable $parser, array $headers = ['Accept' => 'application/json']): ?string
    {
        try {
            $response = $this->httpClient->request('GET', $url, [
                'timeout' => 2,
                'headers' => $headers,
            ]);

            if ($response->getStatusCode() !== 200) {
                return null;
            }

            $payload = $response->toArray(false);
            return trim((string) $parser($payload)) ?: null;
        } catch (ClientExceptionInterface | RedirectionExceptionInterface | ServerExceptionInterface | TransportExceptionInterface $e) {
            return null;
        }
    }

    private function fetchFallbackAnimalFact(): string
    {
        $facts = [
            'A group of flamingos is called a flamboyance.',
            'Octopus have three hearts and blue blood.',
            'Sea otters hold hands while sleeping so they do not drift apart.',
            'Elephants are the only mammals that cannot jump.',
            'A newborn kangaroo is about one inch tall at birth.',
            'Dolphins have names for each other and use unique whistles.',
        ];

        return $facts[array_rand($facts)];
    }

    private function fetchFallbackJoke(): string
    {
        $jokes = [
            'Why did the scarecrow win an award? Because he was outstanding in his field.',
            'Why don’t skeletons fight each other? They don’t have the guts.',
            'What do you call fake spaghetti? An impasta.',
            'Why was the math book sad? It had too many problems.',
            'Why did the computer show up at work late? It had a hard drive.',
        ];

        return $jokes[array_rand($jokes)];
    }

    private function fetchFallbackAnimalImage(): string
    {
        return 'https://placekitten.com/400/240';
    }
}
