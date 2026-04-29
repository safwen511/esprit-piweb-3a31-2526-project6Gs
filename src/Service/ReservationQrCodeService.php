<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\SvgWriter;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class ReservationQrCodeService
{
    private const STORAGE_DIRECTORY = 'var/reservations/qr';
    private const DEFAULT_FILE_EXTENSION = 'svg';

    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly EntityManagerInterface $entityManager,
        #[Autowire('%kernel.project_dir%')]
        private readonly string $projectDir,
    ) {
    }

    public function generateAndStore(Reservation $reservation): void
    {
        $reservationId = $reservation->getId();

        if ($reservationId === null) {
            throw new \LogicException('The reservation must be persisted before generating a QR code.');
        }

        $directory = $this->getStorageDirectory();

        if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
            throw new \RuntimeException('The reservation QR code directory could not be created.');
        }

        $relativePath = sprintf('%s/reservation-%d.%s', self::STORAGE_DIRECTORY, $reservationId, self::DEFAULT_FILE_EXTENSION);
        $absolutePath = $this->projectDir.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $relativePath);

        $result = (new Builder(
            writer: new SvgWriter(),
            data: $this->urlGenerator->generate('app_reservation_details', [
                'id' => $reservationId,
            ], UrlGeneratorInterface::ABSOLUTE_URL),
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 320,
            margin: 18,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
        ))->build();

        $result->saveToFile($absolutePath);

        $reservation
            ->setQrCodePath($relativePath)
            ->setQrCodeGeneratedAt(new \DateTimeImmutable());

        $this->entityManager->flush();
    }

    public function ensureQrCodeExists(Reservation $reservation): string
    {
        $relativePath = $reservation->getQrCodePath();

        if ($relativePath === null || $relativePath === '' || !is_file($this->resolveAbsolutePath($relativePath))) {
            $this->generateAndStore($reservation);
            $relativePath = $reservation->getQrCodePath();
        }

        if ($relativePath === null || $relativePath === '') {
            throw new \RuntimeException('The reservation QR code path is missing.');
        }

        return $this->resolveAbsolutePath($relativePath);
    }

    public function getDownloadFilename(Reservation $reservation): string
    {
        return sprintf('reservation-%d-qr.%s', $reservation->getId(), $this->getFileExtension($reservation->getQrCodePath()));
    }

    public function getMimeTypeForPath(string $path): string
    {
        return match ($this->getFileExtension($path)) {
            'svg' => 'image/svg+xml',
            default => 'image/png',
        };
    }

    private function getStorageDirectory(): string
    {
        return $this->projectDir.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, self::STORAGE_DIRECTORY);
    }

    private function resolveAbsolutePath(string $relativePath): string
    {
        return $this->projectDir.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, ltrim($relativePath, '/'));
    }

    private function getFileExtension(?string $path): string
    {
        $extension = strtolower((string) pathinfo((string) $path, PATHINFO_EXTENSION));

        return $extension !== '' ? $extension : self::DEFAULT_FILE_EXTENSION;
    }
}
