<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use App\Service\ReservationQrCodeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin/pet-hotels/reservations', name: 'app_reservation_')]
final class ReservationController extends AbstractController
{
    public function __construct(
        private readonly TranslatorInterface $translator,
    ) {
    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAllOrdered(),
        ]);
    }

    #[Route('/{id}/approve', name: 'approve', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function approve(
        Request $request,
        Reservation $reservation,
        ReservationQrCodeService $reservationQrCodeService,
        EntityManagerInterface $entityManager,
    ): RedirectResponse|JsonResponse {
        $this->updateStatus($request, $reservation, $entityManager, 'APPROVED', 'approve', $reservationQrCodeService);

        if ($request->isXmlHttpRequest()) {
            return $this->json($this->reservationAjaxPayload($reservation, 'hotel_page.flash.reservation_approved'));
        }

        return $this->redirectToRoute('app_reservation_index');
    }

    #[Route('/{id}/decline', name: 'decline', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function decline(
        Request $request,
        Reservation $reservation,
        EntityManagerInterface $entityManager,
    ): RedirectResponse|JsonResponse {
        $this->updateStatus($request, $reservation, $entityManager, 'DECLINED', 'decline');

        if ($request->isXmlHttpRequest()) {
            return $this->json($this->reservationAjaxPayload($reservation, 'hotel_page.flash.reservation_declined'));
        }

        return $this->redirectToRoute('app_reservation_index');
    }

    private function updateStatus(
        Request $request,
        Reservation $reservation,
        EntityManagerInterface $entityManager,
        string $status,
        string $tokenAction,
        ?ReservationQrCodeService $reservationQrCodeService = null,
    ): void {
        if (!$this->isCsrfTokenValid('reservation-'.$tokenAction.'-'.$reservation->getId(), (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException($this->translator->trans('hotel_page.access.invalid_reservation_update'));
        }

        if (strtoupper($reservation->getStatus()) === 'CANCELLED') {
            $this->addFlash('warning', 'hotel_page.flash.cancelled_unchanged');

            return;
        }

        $reservation->setStatus($status);
        $entityManager->flush();

        if (strtoupper($status) === 'APPROVED' && $reservationQrCodeService instanceof ReservationQrCodeService) {
            $reservationQrCodeService->generateAndStore($reservation);
        }

        $this->addFlash('success', match (strtoupper($status)) {
            'APPROVED' => 'hotel_page.flash.reservation_approved',
            'DECLINED' => 'hotel_page.flash.reservation_declined',
            default => 'hotel_page.flash.reservation_updated',
        });
    }

    /**
     * @return array{success: true, message: string, statusLabel: string, statusClass: string}
     */
    private function reservationAjaxPayload(Reservation $reservation, string $message): array
    {
        $status = strtolower($reservation->getStatus());

        return [
            'success' => true,
            'message' => $message,
            'statusLabel' => $this->translator->trans('hotel_page.status.'.($status ?: 'pending')),
            'statusClass' => 'hotel-module-status hotel-module-status--'.(in_array($status, ['approved', 'declined', 'cancelled'], true) ? $status : 'pending'),
        ];
    }
}
