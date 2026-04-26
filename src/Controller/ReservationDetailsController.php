<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Reservation;
use App\Security\ReservationVoter;
use App\Service\ReservationQrCodeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class ReservationDetailsController extends AbstractController
{
    #[Route('/reservation/{id}/details', name: 'app_reservation_details', requirements: ['id' => '\d+'], methods: ['GET'])]
    #[IsGranted(ReservationVoter::VIEW, subject: 'reservation')]
    public function details(Reservation $reservation): Response
    {
        return $this->render('reservation/details.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    #[Route('/reservation/{id}/qr', name: 'app_reservation_qr', requirements: ['id' => '\d+'], methods: ['GET'])]
    #[IsGranted(ReservationVoter::QR, subject: 'reservation')]
    public function qr(Reservation $reservation, ReservationQrCodeService $reservationQrCodeService): BinaryFileResponse
    {
        return $this->createQrResponse(
            $reservation,
            $reservationQrCodeService,
            ResponseHeaderBag::DISPOSITION_INLINE,
        );
    }

    #[Route('/reservation/{id}/qr/download', name: 'app_reservation_qr_download', requirements: ['id' => '\d+'], methods: ['GET'])]
    #[IsGranted(ReservationVoter::QR, subject: 'reservation')]
    public function downloadQr(Reservation $reservation, ReservationQrCodeService $reservationQrCodeService): BinaryFileResponse
    {
        return $this->createQrResponse(
            $reservation,
            $reservationQrCodeService,
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
        );
    }

    private function createQrResponse(
        Reservation $reservation,
        ReservationQrCodeService $reservationQrCodeService,
        string $disposition,
    ): BinaryFileResponse {
        $path = $reservationQrCodeService->ensureQrCodeExists($reservation);
        $response = new BinaryFileResponse($path);
        $response->headers->set('Content-Type', $reservationQrCodeService->getMimeTypeForPath($path));
        $response->setContentDisposition($disposition, $reservationQrCodeService->getDownloadFilename($reservation));

        return $response;
    }
}
