<?php

declare(strict_types=1);

namespace App\Service\Shopges;

use App\Entity\Shopges\Produit;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Symfony\Component\Process\Process;

final class ShopAiRecommendationService
{
    private const DEFAULT_BOOT_TIMEOUT = 12.0;
    private const STARTUP_MARKER_TTL = 90;

    public function __construct(
        #[Autowire('%kernel.project_dir%')]
        private readonly string $projectDir,
        private readonly string $host = '127.0.0.1',
        private readonly int $port = 7863,
    ) {
    }

    /**
     * @param list<Produit> $products
     * @return array{warning:?string,recommendations:list<array<string,mixed>>,upsell_bundle:?array<string,mixed>}
     */
    public function recommend(
        array $products,
        string $petType,
        string $age,
        string $symptomsOrNeed,
        ?float $budget,
        string $preferredCategory,
        int $limit = 5,
    ): array {
        $payload = [
            'pet_type' => trim($petType),
            'age' => trim($age),
            'symptoms_or_need' => trim($symptomsOrNeed),
            'budget' => $budget,
            'preferred_category' => trim($preferredCategory),
            'limit' => min(5, max(3, $limit)),
            'products' => array_values(array_filter(array_map(
                fn (mixed $product): ?array => $product instanceof Produit ? $this->mapProduct($product) : null,
                $products,
            ))),
        ];

        $response = $this->postJson('/recommend', $payload);

        return [
            'warning' => isset($response['warning']) && is_string($response['warning']) && $response['warning'] !== ''
                ? $response['warning']
                : null,
            'recommendations' => array_values(array_filter(
                $response['recommendations'] ?? [],
                static fn (mixed $item): bool => is_array($item)
            )),
            'upsell_bundle' => isset($response['upsell_bundle']) && is_array($response['upsell_bundle'])
                ? $response['upsell_bundle']
                : null,
        ];
    }

    /**
     * @return array{description:string,image_caption:?string,confidence_note:string}
     */
    public function generateDescription(
        string $title,
        string $category,
        ?float $price,
        ?float $tva,
        ?int $stock,
        ?UploadedFile $uploadedFile = null,
        string $existingDescription = '',
    ): array {
        $this->ensureServiceAvailable(self::DEFAULT_BOOT_TIMEOUT);

        $fields = [
            'title' => trim($title),
            'category' => trim($category),
            'price' => $price !== null ? (string) $price : '',
            'tva' => $tva !== null ? (string) $tva : '',
            'stock' => $stock !== null ? (string) $stock : '',
            'existing_description' => trim($existingDescription),
        ];

        if ($uploadedFile instanceof UploadedFile) {
            $realPath = $uploadedFile->getRealPath();
            if (!is_string($realPath) || $realPath === '' || !is_file($realPath)) {
                throw new \RuntimeException('The uploaded image could not be prepared for AI description generation.');
            }

            $fields['image'] = DataPart::fromPath(
                $realPath,
                $uploadedFile->getClientOriginalName() ?: basename($realPath),
                $uploadedFile->getMimeType() ?: 'application/octet-stream',
            );
        }

        $formData = new FormDataPart($fields);
        $response = HttpClient::create()->request('POST', $this->baseUrl().'/generate-description', [
            'headers' => $formData->getPreparedHeaders()->toArray(),
            'body' => $formData->bodyToIterable(),
            'timeout' => 180,
        ]);
        $statusCode = $response->getStatusCode();
        $content = $response->getContent(false);

        if ($statusCode === 404) {
            throw new \RuntimeException(
                'The shop AI helper is running an older version. Restart it with: powershell -ExecutionPolicy Bypass -File tools\\shopges_ai\\start.ps1'
            );
        }

        $payload = $this->decodeResponse($statusCode, $content);

        return [
            'description' => (string) ($payload['description'] ?? ''),
            'image_caption' => isset($payload['image_caption']) && is_string($payload['image_caption']) ? $payload['image_caption'] : null,
            'confidence_note' => (string) ($payload['confidence_note'] ?? 'Description generated.'),
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
                'message' => 'The shop AI helper is ready.',
                'manual_command' => $this->manualStartCommand(),
            ];
        }

        if ($boot) {
            $this->bootService();
        }

        return [
            'ready' => false,
            'warming_up' => true,
            'message' => 'The shop AI helper is warming up.',
            'manual_command' => $this->manualStartCommand(),
        ];
    }

    private function baseUrl(): string
    {
        return sprintf('http://%s:%d', $this->host, $this->port);
    }

    /**
     * @param array<string, mixed> $payload
     * @return array<string, mixed>
     */
    private function postJson(string $path, array $payload): array
    {
        $this->ensureServiceAvailable(self::DEFAULT_BOOT_TIMEOUT);

        $response = HttpClient::create()->request('POST', $this->baseUrl().$path, [
            'json' => $payload,
            'timeout' => 120,
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

        throw new \RuntimeException('The shop AI helper is still warming up. Please wait a few seconds and try again.');
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

            throw new \RuntimeException('The shop AI helper could not be started automatically.', 0, $exception);
        }
    }

    private function startService(): void
    {
        $pythonPath = $this->projectDir.DIRECTORY_SEPARATOR.'tools'.DIRECTORY_SEPARATOR.'shop_ai'.DIRECTORY_SEPARATOR.'.venv'.DIRECTORY_SEPARATOR.'Scripts'.DIRECTORY_SEPARATOR.'python.exe';
        $scriptPath = $this->projectDir.DIRECTORY_SEPARATOR.'tools'.DIRECTORY_SEPARATOR.'shop_ai'.DIRECTORY_SEPARATOR.'app.py';

        if (!is_file($scriptPath)) {
            throw new \RuntimeException('The shop AI helper script is missing.');
        }

        if (!is_file($pythonPath)) {
            throw new \RuntimeException('The shop AI helper virtual environment is missing.');
        }

        $command = PHP_OS_FAMILY === 'Windows'
            ? sprintf(
                'cmd /c start "" /B %s -u %s --host %s --port %d',
                escapeshellarg($pythonPath),
                escapeshellarg($scriptPath),
                escapeshellarg($this->host),
                $this->port,
            )
            : sprintf(
                'nohup %s -u %s --host %s --port %d >/dev/null 2>&1 &',
                escapeshellarg($pythonPath),
                escapeshellarg($scriptPath),
                escapeshellarg($this->host),
                $this->port,
            );

        Process::fromShellCommandline($command, $this->projectDir)->run();
    }

    private function startupMarkerPath(): string
    {
        return $this->projectDir.DIRECTORY_SEPARATOR.'var'.DIRECTORY_SEPARATOR.'shop_ai_starting.lock';
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

    /**
     * @return array{id:int,title:string,description:string,category:string,visible_price:float,stock:int}
     */
    private function mapProduct(Produit $product): array
    {
        return [
            'id' => (int) $product->getId(),
            'title' => (string) $product->getTitle(),
            'description' => (string) ($product->getDescription() ?? ''),
            'category' => $product->getCategory(),
            'visible_price' => round($product->getVisiblePrice(), 2),
            'stock' => max(0, (int) $product->getStock()),
        ];
    }

    private function manualStartCommand(): string
    {
        return 'powershell -ExecutionPolicy Bypass -File tools\\shopges_ai\\start.ps1';
    }

    /**
     * @return array<string, mixed>
     */
    private function decodeResponse(int $statusCode, string $content): array
    {
        $decoded = json_decode($content, true);
        $payload = is_array($decoded) ? $decoded : [];

        if ($statusCode >= 400) {
            $detail = $payload['detail'] ?? $payload['reason'] ?? 'The shop AI helper rejected the request.';

            throw new \RuntimeException((string) $detail);
        }

        return $payload;
    }
}


