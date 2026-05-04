<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Reservation;
use App\Service\ReservationQrCodeService;
use App\Tests\Support\EntityIdTrait;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class ReservationQrCodeServiceTest extends TestCase
{
    use EntityIdTrait;

    public function testGenerateAndStoreCreatesSvgQrCodeAndUpdatesReservation(): void
    {
        $projectDir = sys_get_temp_dir().DIRECTORY_SEPARATOR.'furhope-qr-'.bin2hex(random_bytes(4));
        mkdir($projectDir, 0777, true);

        $reservation = new Reservation();
        self::setEntityId($reservation, 123);

        $urls = $this->createMock(UrlGeneratorInterface::class);
        $urls->expects(self::once())
            ->method('generate')
            ->with('app_reservation_details', ['id' => 123], UrlGeneratorInterface::ABSOLUTE_URL)
            ->willReturn('https://furhope.test/reservations/123');

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects(self::once())->method('flush');

        $service = new ReservationQrCodeService($urls, $entityManager, $projectDir);
        $service->generateAndStore($reservation);

        self::assertSame('var/reservations/qr/reservation-123.svg', $reservation->getQrCodePath());
        self::assertTrue($reservation->hasQrCode());
        self::assertFileExists($projectDir.DIRECTORY_SEPARATOR.'var'.DIRECTORY_SEPARATOR.'reservations'.DIRECTORY_SEPARATOR.'qr'.DIRECTORY_SEPARATOR.'reservation-123.svg');
        self::assertSame('reservation-123-qr.svg', $service->getDownloadFilename($reservation));
        self::assertSame('image/svg+xml', $service->getMimeTypeForPath($reservation->getQrCodePath() ?? ''));
    }

    public function testUnsavedReservationCannotGenerateQrCode(): void
    {
        $service = new ReservationQrCodeService(
            $this->createMock(UrlGeneratorInterface::class),
            $this->createMock(EntityManagerInterface::class),
            sys_get_temp_dir()
        );

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('persisted before generating');

        $service->generateAndStore(new Reservation());
    }
}
