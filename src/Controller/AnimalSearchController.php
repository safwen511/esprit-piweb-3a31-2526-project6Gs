<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnimalSearchController extends AbstractController
{
    #[Route('/animals/search', name: 'app_animal_search', methods: ['GET'])]
    public function search(HttpClientInterface $httpClient, Request $request): Response
    {
        $animalName = trim((string) $request->query->get('q', ''));
        $wiki = null;
        $error = null;

        if ($animalName !== '') {
            try {
                $encodedName = urlencode($animalName);
                $response = $httpClient->request('GET', "https://en.wikipedia.org/api/rest_v1/page/summary/{$encodedName}");

                if ($response->getStatusCode() === 200) {
                    $data = $response->toArray(false);
                    if (isset($data['type']) && $data['type'] === 'standard' && isset($data['extract'])) {
                        $wiki = [
                            'title' => $data['title'] ?? '',
                            'extract' => $data['extract'] ?? '',
                            'thumbnail' => $data['thumbnail'] ?? null,
                        ];
                    } else {
                        $error = 'No information found for this animal';
                    }
                } else {
                    $error = 'Unable to fetch data at the moment';
                }
            } catch (\Throwable $th) {
                $error = 'Unable to fetch data at the moment';
            }
        }

        return $this->render('animal/search.html.twig', [
            'animalName' => $animalName,
            'wiki' => $wiki,
            'error' => $error,
        ]);
    }
}

