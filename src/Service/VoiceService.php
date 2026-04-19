<?php

namespace App\Service;

use App\Exception\VoiceServiceException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;

/**
 * Talks to the local Python voice microservice for enrollment and verification.
 */
class VoiceService
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $baseUrl = 'http://localhost:5001',
    ) {
    }

    /**
     * Extracts a biometric voice vector from a local audio file.
     *
     * @return list<float>
     */
    public function enroll(string $audioPath): array
    {
        $response = $this->postMultipart('/extract', [
            'file' => DataPart::fromPath($audioPath),
        ]);

        if (!isset($response['vector']) || !is_array($response['vector'])) {
            throw new VoiceServiceException('The voice service did not return a valid enrollment vector.');
        }

        return array_map('floatval', $response['vector']);
    }

    /**
     * Detects whether an uploaded audio sample contains enough clear speech to be processed.
     *
     * @return array{detected: bool, speechSeconds: float, sampleRate: int}
     */
    public function detect(string $audioPath): array
    {
        $response = $this->postMultipart('/detect', [
            'file' => DataPart::fromPath($audioPath),
        ]);

        if (
            !isset($response['detected'], $response['speechSeconds'], $response['sampleRate'])
            || $response['detected'] !== true
        ) {
            throw new VoiceServiceException('The voice service did not return a valid detection result.');
        }

        return [
            'detected' => true,
            'speechSeconds' => (float) $response['speechSeconds'],
            'sampleRate' => (int) $response['sampleRate'],
        ];
    }

    /**
     * Verifies a live audio sample against a stored biometric voice vector.
     *
     * @param list<float> $storedVector
     *
     * @return array{
     *     score: float,
     *     match: bool,
     *     metrics?: array{
     *         primaryScore: float,
     *         referenceScore: float,
     *         vectorDistance: float,
     *         durationRatio: float,
     *         durationGapSeconds: float,
     *         dtwSimilarity: float
     *     }
     * }
     */
    public function verify(string $audioPath, array $storedVector, ?string $referenceAudioPath = null): array
    {
        $fields = [
            'file' => DataPart::fromPath($audioPath),
            'stored_vector' => json_encode(array_values($storedVector), JSON_THROW_ON_ERROR),
        ];

        if ($referenceAudioPath !== null && is_file($referenceAudioPath)) {
            $fields['reference_file'] = DataPart::fromPath($referenceAudioPath);
        }

        $response = $this->postMultipart('/compare', $fields);

        if (!isset($response['score'], $response['match'])) {
            throw new VoiceServiceException('The voice service did not return a valid verification result.');
        }

        $result = [
            'score' => (float) $response['score'],
            'match' => (bool) $response['match'],
        ];

        if (isset($response['metrics']) && is_array($response['metrics'])) {
            $result['metrics'] = [
                'primaryScore' => (float) ($response['metrics']['primaryScore'] ?? 0.0),
                'referenceScore' => (float) ($response['metrics']['referenceScore'] ?? 0.0),
                'vectorDistance' => (float) ($response['metrics']['vectorDistance'] ?? 0.0),
                'durationRatio' => (float) ($response['metrics']['durationRatio'] ?? 0.0),
                'durationGapSeconds' => (float) ($response['metrics']['durationGapSeconds'] ?? 0.0),
                'dtwSimilarity' => (float) ($response['metrics']['dtwSimilarity'] ?? 0.0),
            ];
        }

        return $result;
    }

    /**
     * Sends a multipart request to the local Python service and returns the decoded JSON payload.
     */
    private function postMultipart(string $path, array $fields): array
    {
        try {
            $formData = new FormDataPart($fields);
            $response = $this->httpClient->request('POST', rtrim($this->baseUrl, '/').$path, [
                'headers' => $formData->getPreparedHeaders()->toArray(),
                'body' => $formData->bodyToIterable(),
            ]);

            $statusCode = $response->getStatusCode();
            $payload = $response->toArray(false);

            if ($statusCode >= 400) {
                $detail = $payload['detail'] ?? null;
                $message = is_string($detail) && trim($detail) !== ''
                    ? trim($detail)
                    : 'The local voice service rejected the request.';

                throw new VoiceServiceException($message);
            }

            return $payload;
        } catch (\Throwable $exception) {
            if ($exception instanceof VoiceServiceException) {
                throw $exception;
            }

            throw new VoiceServiceException('The local voice service is unavailable.', 0, $exception);
        }
    }
}
