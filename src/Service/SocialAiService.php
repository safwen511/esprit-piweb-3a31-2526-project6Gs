<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Symfony\Component\Process\Process;

final class SocialAiService
{
    private const DEFAULT_BOOT_TIMEOUT = 18.0;
    private const STARTUP_MARKER_TTL = 90;

    public function __construct(
        #[Autowire('%kernel.project_dir%')]
        private readonly string $projectDir,
        private readonly string $host = '127.0.0.1',
        private readonly int $port = 7861,
        private readonly string $pythonBin = 'python',
    ) {
    }

    /**
     * @return array{blocked:bool,allowed:bool,toxic_score:float,reason:string}
     */
    public function moderateCaption(string $caption): array
    {
        $payload = $this->postForm('/moderate/text', [
            'caption' => $caption,
        ]);

        return [
            'blocked' => (bool) ($payload['blocked'] ?? false),
            'allowed' => (bool) ($payload['allowed'] ?? true),
            'toxic_score' => (float) ($payload['toxic_score'] ?? 0.0),
            'reason' => (string) ($payload['reason'] ?? 'Caption moderation completed.'),
        ];
    }

    /**
     * @return array{blocked:bool,allowed:bool,reason:string,nsfw_score:float,animal_confidence:float,detected_label:string}
     */
    public function moderateImagePath(string $path): array
    {
        $payload = $this->postFile('/moderate/image', $path);

        return [
            'blocked' => (bool) ($payload['blocked'] ?? false),
            'allowed' => (bool) ($payload['allowed'] ?? true),
            'reason' => (string) ($payload['reason'] ?? 'Image moderation completed.'),
            'nsfw_score' => (float) ($payload['nsfw_score'] ?? 0.0),
            'animal_confidence' => (float) ($payload['animal_confidence'] ?? 0.0),
            'detected_label' => (string) ($payload['detected_label'] ?? ''),
        ];
    }

    /**
     * @return array{caption:string,detected_label:string}
     */
    public function suggestCaptionFromUpload(UploadedFile $uploadedFile): array
    {
        $realPath = $uploadedFile->getRealPath();
        if (!is_string($realPath) || $realPath === '' || !is_file($realPath)) {
            throw new \RuntimeException('The selected image could not be prepared for AI captioning.');
        }

        $payload = $this->postFile('/caption/suggest', $realPath);

        return [
            'caption' => (string) ($payload['caption'] ?? ''),
            'detected_label' => (string) ($payload['detected_label'] ?? ''),
        ];
    }

    /**
     * @return array{
     *     caption: array{blocked: bool, allowed: bool, toxic_score: float, reason: string}|null,
     *     image: array{blocked: bool, allowed: bool, reason: string, nsfw_score: float, animal_confidence: float, detected_label: string}|null
     * }
     */
    public function moderatePostDraft(
        ?string $caption,
        ?string $mediaType,
        ?UploadedFile $uploadedFile = null,
        ?string $mediaPath = null,
    ): array {
        $captionResult = null;
        $imageResult = null;

        $trimmedCaption = trim((string) $caption);
        if ($trimmedCaption !== '') {
            $captionResult = $this->moderateCaption($trimmedCaption);
        }

        if (strtoupper(trim((string) $mediaType)) !== 'IMAGE') {
            return [
                'caption' => $captionResult,
                'image' => null,
            ];
        }

        $imageSource = $this->resolveImageSource($uploadedFile, $mediaPath);
        if ($imageSource === null) {
            return [
                'caption' => $captionResult,
                'image' => null,
            ];
        }

        try {
            $imageResult = $this->moderateImagePath($imageSource['path']);
        } finally {
            if ($imageSource['temporary'] && is_file($imageSource['path'])) {
                @unlink($imageSource['path']);
            }
        }

        return [
            'caption' => $captionResult,
            'image' => $imageResult,
        ];
    }

    /**
     * @return array{ready:bool,warming_up:bool,message:string,manual_command:string}
     */
    public function warmUp(bool $boot = true): array
    {
        if ($this->isServiceHealthy()) {
            return [
                'ready' => true,
                'warming_up' => false,
                'message' => 'The local AI service is ready.',
                'manual_command' => $this->manualStartCommand(),
            ];
        }

        if ($boot) {
            $this->bootService();
        }

        return [
            'ready' => false,
            'warming_up' => true,
            'message' => 'The local AI service is warming up.',
            'manual_command' => $this->manualStartCommand(),
        ];
    }

    /**
     * @return array{path:string,temporary:bool}|null
     */
    private function resolveImageSource(?UploadedFile $uploadedFile, ?string $mediaPath): ?array
    {
        if ($uploadedFile instanceof UploadedFile) {
            $realPath = $uploadedFile->getRealPath();
            if (!is_string($realPath) || $realPath === '' || !is_file($realPath)) {
                throw new \RuntimeException('The uploaded image could not be inspected.');
            }

            return [
                'path' => $realPath,
                'temporary' => false,
            ];
        }

        $mediaPath = trim((string) $mediaPath);
        if ($mediaPath === '') {
            return null;
        }

        if (str_starts_with($mediaPath, 'http://') || str_starts_with($mediaPath, 'https://')) {
            return [
                'path' => $this->downloadRemoteImage($mediaPath),
                'temporary' => true,
            ];
        }

        $candidatePath = $mediaPath;
        if (!$this->isAbsolutePath($candidatePath)) {
            $candidatePath = $this->projectDir.'/public/'.ltrim(str_replace('\\', '/', $candidatePath), '/');
        }

        $realPath = realpath($candidatePath);
        if ($realPath === false || !is_file($realPath)) {
            throw new \RuntimeException('The selected image path could not be inspected by the AI service.');
        }

        return [
            'path' => $realPath,
            'temporary' => false,
        ];
    }

    private function downloadRemoteImage(string $url): string
    {
        $temporaryPath = tempnam(sys_get_temp_dir(), 'social-ai-');
        if ($temporaryPath === false) {
            throw new \RuntimeException('A temporary file could not be created for AI inspection.');
        }

        try {
            $response = HttpClient::create()->request('GET', $url, [
                'timeout' => 20,
                'max_redirects' => 3,
            ]);

            if ($response->getStatusCode() >= 400) {
                throw new \RuntimeException('The remote image could not be downloaded for AI inspection.');
            }

            file_put_contents($temporaryPath, $response->getContent());
        } catch (\Throwable $exception) {
            @unlink($temporaryPath);
            throw new \RuntimeException('The remote image could not be downloaded for AI inspection.', 0, $exception);
        }

        return $temporaryPath;
    }

    private function baseUrl(): string
    {
        return sprintf('http://%s:%d', $this->host, $this->port);
    }

    /**
     * @param array<string, string> $fields
     *
     * @return array<string, mixed>
     */
    private function postForm(string $path, array $fields): array
    {
        $this->ensureServiceAvailable(self::DEFAULT_BOOT_TIMEOUT);

        $formData = new FormDataPart($fields);
        $response = HttpClient::create()->request('POST', $this->baseUrl().$path, [
            'headers' => $formData->getPreparedHeaders()->toArray(),
            'body' => $formData->bodyToIterable(),
            'timeout' => 180,
        ]);

        return $this->decodeResponse($response->getStatusCode(), $response->getContent(false));
    }

    /**
     * @return array<string, mixed>
     */
    private function postFile(string $path, string $filePath): array
    {
        $this->ensureServiceAvailable(self::DEFAULT_BOOT_TIMEOUT);

        $formData = new FormDataPart([
            'image' => DataPart::fromPath($filePath, basename($filePath), mime_content_type($filePath) ?: 'application/octet-stream'),
        ]);

        $response = HttpClient::create()->request('POST', $this->baseUrl().$path, [
            'headers' => $formData->getPreparedHeaders()->toArray(),
            'body' => $formData->bodyToIterable(),
            'timeout' => 300,
        ]);

        return $this->decodeResponse($response->getStatusCode(), $response->getContent(false));
    }

    private function ensureServiceAvailable(float $timeoutSeconds): void
    {
        if ($this->isServiceHealthy()) {
            return;
        }

        $this->bootService();
        $deadline = microtime(true) + max(4.0, $timeoutSeconds);

        while (microtime(true) < $deadline) {
            usleep(300000);

            if ($this->isServiceHealthy()) {
                return;
            }
        }

        throw new \RuntimeException(
            'The local AI service is still warming up. Please wait a few seconds and try again.',
        );
    }

    private function isServiceHealthy(): bool
    {
        try {
            $response = HttpClient::create()->request('GET', $this->baseUrl().'/health', [
                'timeout' => 2,
            ]);

            $isHealthy = $response->getStatusCode() === 200;
            if ($isHealthy) {
                $this->clearStartupMarker();
            }

            return $isHealthy;
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

            throw new \RuntimeException('The local AI service could not be started automatically.', 0, $exception);
        }
    }

    private function startService(): void
    {
        $scriptPath = $this->projectDir.DIRECTORY_SEPARATOR.'tools'.DIRECTORY_SEPARATOR.'social_ai'.DIRECTORY_SEPARATOR.'app.py';
        if (!is_file($scriptPath)) {
            throw new \RuntimeException('The local AI service script is missing.');
        }

        $command = PHP_OS_FAMILY === 'Windows'
            ? sprintf(
                'cmd /c start "" /B %s -u %s --host %s --port %d',
                escapeshellarg($this->pythonBin),
                escapeshellarg($scriptPath),
                escapeshellarg($this->host),
                $this->port,
            )
            : sprintf(
                'nohup %s -u %s --host %s --port %d >/dev/null 2>&1 &',
                escapeshellarg($this->pythonBin),
                escapeshellarg($scriptPath),
                escapeshellarg($this->host),
                $this->port,
            );

        Process::fromShellCommandline($command, $this->projectDir)->run();
    }

    private function startupMarkerPath(): string
    {
        return $this->projectDir.DIRECTORY_SEPARATOR.'var'.DIRECTORY_SEPARATOR.'social_ai_starting.lock';
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

    private function isAbsolutePath(string $path): bool
    {
        return str_starts_with($path, '/') || preg_match('/^[A-Za-z]:\\\\/', $path) === 1;
    }

    private function manualStartCommand(): string
    {
        return 'powershell -ExecutionPolicy Bypass -File tools\\social_ai\\start.ps1';
    }

    /**
     * @return array<string, mixed>
     */
    private function decodeResponse(int $statusCode, string $content): array
    {
        $decoded = json_decode($content, true);
        $payload = is_array($decoded) ? $decoded : [];

        if ($statusCode >= 400) {
            $detail = $payload['detail'] ?? $payload['reason'] ?? 'The AI service rejected the request.';

            throw new \RuntimeException((string) $detail);
        }

        return $payload;
    }
}
