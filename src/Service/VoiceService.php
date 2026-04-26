<?php

namespace App\Service;

use App\Exception\VoiceServiceException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Process\Process;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;

/**
 * Talks to the local Python voice microservice for enrollment and verification.
 */
class VoiceService
{
    private const DEFAULT_BOOT_TIMEOUT = 18.0;
    private const STARTUP_MARKER_TTL = 120;

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        #[Autowire('%kernel.project_dir%')]
        private readonly string $projectDir,
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
     * @return array{
     *     detected: bool,
     *     speechSeconds: float,
     *     sampleRate: int,
     *     speechDetector?: string,
     *     transcript?: string,
     *     transcriptionLanguage?: string,
     *     transcriptionEngine?: string
     * }
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

        $result = [
            'detected' => true,
            'speechSeconds' => (float) $response['speechSeconds'],
            'sampleRate' => (int) $response['sampleRate'],
        ];

        if (isset($response['speechDetector']) && is_string($response['speechDetector']) && $response['speechDetector'] !== '') {
            $result['speechDetector'] = $response['speechDetector'];
        } elseif (isset($response['engine']) && is_string($response['engine']) && $response['engine'] !== '') {
            $result['speechDetector'] = $response['engine'];
        }

        if (isset($response['transcript']) && is_string($response['transcript'])) {
            $result['transcript'] = trim($response['transcript']);
        }

        if (isset($response['transcriptionLanguage']) && is_string($response['transcriptionLanguage']) && $response['transcriptionLanguage'] !== '') {
            $result['transcriptionLanguage'] = $response['transcriptionLanguage'];
        }

        if (isset($response['transcriptionEngine']) && is_string($response['transcriptionEngine']) && $response['transcriptionEngine'] !== '') {
            $result['transcriptionEngine'] = $response['transcriptionEngine'];
        }

        return $result;
    }

    /**
     * Verifies a live audio sample against a stored biometric voice vector.
     *
     * @param list<float> $storedVector
     *
     * @return array{
     *     score: float,
     *     match: bool,
     *     transcript?: string,
     *     transcriptionLanguage?: string,
     *     transcriptionEngine?: string,
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

        if (isset($response['transcript']) && is_string($response['transcript'])) {
            $result['transcript'] = trim($response['transcript']);
        }

        if (isset($response['transcriptionLanguage']) && is_string($response['transcriptionLanguage']) && $response['transcriptionLanguage'] !== '') {
            $result['transcriptionLanguage'] = $response['transcriptionLanguage'];
        }

        if (isset($response['transcriptionEngine']) && is_string($response['transcriptionEngine']) && $response['transcriptionEngine'] !== '') {
            $result['transcriptionEngine'] = $response['transcriptionEngine'];
        }

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
        $this->ensureServiceAvailable(self::DEFAULT_BOOT_TIMEOUT);

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

    private function ensureServiceAvailable(float $timeoutSeconds): void
    {
        if ($this->isServiceHealthy()) {
            return;
        }

        if (!$this->isLocalBaseUrl()) {
            throw new VoiceServiceException('The configured voice service is unavailable.');
        }

        $this->bootService();
        $deadline = microtime(true) + max(6.0, $timeoutSeconds);

        while (microtime(true) < $deadline) {
            usleep(300000);

            if ($this->isServiceHealthy()) {
                return;
            }
        }

        throw new VoiceServiceException(
            'The local voice service is still starting. Please wait a few seconds and try again.'
        );
    }

    private function isServiceHealthy(): bool
    {
        try {
            $response = $this->httpClient->request('GET', rtrim($this->baseUrl, '/').'/health', [
                'timeout' => 2,
            ]);

            $healthy = $response->getStatusCode() === 200;
            if ($healthy) {
                $this->clearStartupMarker();
            }

            return $healthy;
        } catch (\Throwable) {
            return false;
        }
    }

    private function bootService(): void
    {
        if ($this->isServiceHealthy() || $this->hasRecentStartupAttempt()) {
            return;
        }

        $this->writeStartupMarker();

        try {
            $this->startService();
        } catch (\Throwable $exception) {
            $this->clearStartupMarker();

            throw new VoiceServiceException(
                'The local voice service could not be started automatically. Start it with: '.$this->manualStartCommand(),
                0,
                $exception,
            );
        }
    }

    private function startService(): void
    {
        $startScriptPath = $this->projectDir.DIRECTORY_SEPARATOR.'tools'.DIRECTORY_SEPARATOR.'voice_service'.DIRECTORY_SEPARATOR.'start.ps1';

        if (!is_file($startScriptPath)) {
            throw new \RuntimeException('The voice service start script is missing.');
        }

        $host = $this->baseHost();
        $port = $this->basePort();

        $command = PHP_OS_FAMILY === 'Windows'
            ? sprintf(
                'cmd /c start "" /B powershell -ExecutionPolicy Bypass -File %s -BindHost %s -Port %d',
                escapeshellarg($startScriptPath),
                escapeshellarg($host),
                $port,
            )
            : sprintf(
                'nohup sh -lc %s >/dev/null 2>&1 &',
                escapeshellarg(sprintf(
                    'python3 %s --host %s --port %d',
                    escapeshellarg($this->projectDir.DIRECTORY_SEPARATOR.'voice_service.py'),
                    escapeshellarg($host),
                    $port,
                )),
            );

        Process::fromShellCommandline($command, $this->projectDir)->run();
    }

    private function isLocalBaseUrl(): bool
    {
        $host = mb_strtolower($this->baseHost());

        return in_array($host, ['localhost', '127.0.0.1'], true);
    }

    private function baseHost(): string
    {
        $host = parse_url($this->baseUrl, PHP_URL_HOST);

        return is_string($host) && $host !== '' ? $host : '127.0.0.1';
    }

    private function basePort(): int
    {
        $port = parse_url($this->baseUrl, PHP_URL_PORT);

        return is_int($port) && $port > 0 ? $port : 5001;
    }

    private function startupMarkerPath(): string
    {
        return $this->projectDir.DIRECTORY_SEPARATOR.'var'.DIRECTORY_SEPARATOR.'voice_service_starting.lock';
    }

    private function hasRecentStartupAttempt(): bool
    {
        $markerPath = $this->startupMarkerPath();
        if (!is_file($markerPath)) {
            return false;
        }

        $startedAt = (int) file_get_contents($markerPath);
        if ($startedAt > 0 && (time() - $startedAt) < self::STARTUP_MARKER_TTL) {
            return true;
        }

        @unlink($markerPath);

        return false;
    }

    private function writeStartupMarker(): void
    {
        $markerDirectory = dirname($this->startupMarkerPath());
        if (!is_dir($markerDirectory)) {
            @mkdir($markerDirectory, 0777, true);
        }

        file_put_contents($this->startupMarkerPath(), (string) time());
    }

    private function clearStartupMarker(): void
    {
        $markerPath = $this->startupMarkerPath();
        if (is_file($markerPath)) {
            @unlink($markerPath);
        }
    }

    private function manualStartCommand(): string
    {
        return 'powershell -ExecutionPolicy Bypass -File tools\\voice_service\\start.ps1';
    }
}
