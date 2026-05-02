<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AnimalSearchController extends AbstractController
{
    #[Route('/animals/search', name: 'app_animal_search', methods: ['GET'])]
    public function search(HttpClientInterface $httpClient, CacheInterface $cache, Request $request): Response
    {
        $animalName = trim((string) $request->query->get('q', ''));
        $wiki = null;
        $error = null;

        if ($animalName !== '') {
            $result = $cache->get('animal_wiki_'.sha1(mb_strtolower($animalName)), function (ItemInterface $item) use ($animalName, $httpClient): array {
                $item->expiresAfter(86400);

                try {
                    $response = $httpClient->request('GET', 'https://en.wikipedia.org/api/rest_v1/page/summary/'.rawurlencode($animalName), [
                        'timeout' => 2.5,
                        'max_duration' => 3.0,
                    ]);

                    if ($response->getStatusCode() !== 200) {
                        return ['wiki' => null, 'error' => 'Unable to fetch data at the moment'];
                    }

                    $data = $response->toArray(false);
                    if (($data['type'] ?? null) !== 'standard' || !isset($data['extract'])) {
                        return ['wiki' => null, 'error' => 'No information found for this animal'];
                    }

                    return [
                        'wiki' => [
                            'title' => (string) ($data['title'] ?? $animalName),
                            'extract' => (string) $data['extract'],
                            'thumbnail' => $data['thumbnail'] ?? null,
                        ],
                        'error' => null,
                    ];
                } catch (\Throwable) {
                    $item->expiresAfter(60);

                    return ['wiki' => null, 'error' => 'Unable to fetch data at the moment'];
                }
            });

            $wiki = $result['wiki'];
            $error = $result['error'];
        }

        return $this->render('animal/search.html.twig', [
            'animalName' => $animalName,
            'wiki' => $wiki,
            'error' => $error,
        ]);
    }
}
