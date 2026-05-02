<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class AnimalImagePredictionService
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $host = '127.0.0.1',
        private readonly int $port = 7862,
    ) {
    }

    /**
     * @return array{
     *     is_animal: bool,
     *     message: string,
     *     animal_confidence: float,
     *     species: array{label:string,confidence:float}|null,
     *     breed: array{label:string,confidence:float}|null,
     *     species_alternatives: list<array{label:string,confidence:float}>,
     *     breed_alternatives: list<array{label:string,confidence:float}>
     * }
     */
    public function predictFromUpload(UploadedFile $uploadedFile): array
    {
        $realPath = $uploadedFile->getRealPath();
        if (!is_string($realPath) || $realPath === '' || !is_file($realPath)) {
            throw new \RuntimeException('The uploaded image could not be prepared for prediction.');
        }

        try {
            $formData = new FormDataPart([
                'image' => DataPart::fromPath(
                    $realPath,
                    $uploadedFile->getClientOriginalName() ?: basename($realPath),
                    $uploadedFile->getMimeType() ?: 'application/octet-stream'
                ),
            ]);

            $response = $this->httpClient->request('POST', sprintf('http://%s:%d/predict/species-breed', $this->host, $this->port), [
                'headers' => $formData->getPreparedHeaders()->toArray(),
                'body' => $formData->bodyToIterable(),
                'timeout' => 180,
            ]);
            $statusCode = $response->getStatusCode();
            $payload = $response->toArray(false);
        } catch (\Throwable $exception) {
            throw new \RuntimeException(
                'Animal AI service is unavailable. Start it with: powershell -ExecutionPolicy Bypass -File tools\\animal_ai\\start.ps1',
                0,
                $exception,
            );
        }

        if ($statusCode >= 400) {
            throw new \RuntimeException('Animal prediction failed. Please retry with another image.');
        }

        $speciesPayload = is_array($payload['species'] ?? null) ? $payload['species'] : null;
        $breedPayload = is_array($payload['breed'] ?? null) ? $payload['breed'] : null;
        $speciesAlternatives = is_array($payload['species_alternatives'] ?? null) ? $payload['species_alternatives'] : [];
        $breedAlternatives = is_array($payload['breed_alternatives'] ?? null) ? $payload['breed_alternatives'] : [];

        return [
            'is_animal' => (bool) ($payload['is_animal'] ?? false),
            'message' => (string) ($payload['message'] ?? 'Prediction completed.'),
            'animal_confidence' => $this->normalizeConfidence((float) ($payload['animal_confidence'] ?? 0.0)),
            'species' => $speciesPayload !== null ? [
                'label' => (string) ($speciesPayload['label'] ?? ''),
                'confidence' => $this->normalizeConfidence((float) ($speciesPayload['confidence'] ?? 0.0)),
            ] : null,
            'breed' => $breedPayload !== null ? [
                'label' => (string) ($breedPayload['label'] ?? ''),
                'confidence' => $this->normalizeConfidence((float) ($breedPayload['confidence'] ?? 0.0)),
            ] : null,
            'species_alternatives' => $this->mapPredictionList($speciesAlternatives),
            'breed_alternatives' => $this->mapPredictionList($breedAlternatives),
        ];
    }

    /**
     * @param array{
     *   name?: string,
     *   species?: string,
     *   breed?: string,
     *   age_value?: string,
     *   age_unit?: string,
     *   gender?: string
     * } $context
     * @return array{
     *   description: string,
     *   species: string|null,
     *   breed: string|null,
     *   confidence_note: string
     * }
     */
    public function generateDescription(array $context, ?UploadedFile $uploadedFile = null): array
    {
        try {
            $fields = [
                'name' => (string) ($context['name'] ?? ''),
                'species' => (string) ($context['species'] ?? ''),
                'breed' => (string) ($context['breed'] ?? ''),
                'age_value' => (string) ($context['age_value'] ?? ''),
                'age_unit' => (string) ($context['age_unit'] ?? 'months'),
                'gender' => (string) ($context['gender'] ?? ''),
            ];

            if ($uploadedFile instanceof UploadedFile) {
                $realPath = $uploadedFile->getRealPath();
                if (!is_string($realPath) || $realPath === '' || !is_file($realPath)) {
                    throw new \RuntimeException('The uploaded image could not be prepared for description generation.');
                }

                $fields['image'] = DataPart::fromPath(
                    $realPath,
                    $uploadedFile->getClientOriginalName() ?: basename($realPath),
                    $uploadedFile->getMimeType() ?: 'application/octet-stream'
                );
            }

            $formData = new FormDataPart($fields);

            $response = $this->httpClient->request('POST', sprintf('http://%s:%d/generate/description', $this->host, $this->port), [
                'headers' => $formData->getPreparedHeaders()->toArray(),
                'body' => $formData->bodyToIterable(),
                'timeout' => 180,
            ]);
            $statusCode = $response->getStatusCode();
            $payload = $response->toArray(false);
        } catch (\Throwable $exception) {
            throw new \RuntimeException(
                'Animal AI description service is unavailable. Start it with: powershell -ExecutionPolicy Bypass -File tools\\animal_ai\\start.ps1',
                0,
                $exception,
            );
        }

        if ($statusCode >= 400) {
            throw new \RuntimeException('AI description generation failed. Please retry.');
        }

        return [
            'description' => (string) ($payload['description'] ?? ''),
            'species' => isset($payload['species']) && is_string($payload['species']) ? $payload['species'] : null,
            'breed' => isset($payload['breed']) && is_string($payload['breed']) ? $payload['breed'] : null,
            'confidence_note' => (string) ($payload['confidence_note'] ?? 'Description generated.'),
        ];
    }

    private function normalizeConfidence(float $confidence): float
    {
        if ($confidence < 0.0) {
            return 0.0;
        }

        if ($confidence > 1.0) {
            return 1.0;
        }

        return $confidence;
    }

    /**
     * @param mixed $items
     * @return list<array{label:string,confidence:float}>
     */
    private function mapPredictionList(mixed $items): array
    {
        if (!is_array($items)) {
            return [];
        }

        $mapped = [];

        foreach ($items as $item) {
            if (!is_array($item)) {
                continue;
            }

            $mapped[] = [
                'label' => (string) ($item['label'] ?? ''),
                'confidence' => $this->normalizeConfidence((float) ($item['confidence'] ?? 0.0)),
            ];
        }

        return $mapped;
    }
}
