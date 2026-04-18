<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        EntityManagerInterface $entityManager,
    ): RedirectResponse {
        $this->updateStatus($request, $reservation, $entityManager, 'APPROVED', 'approve');

        return $this->redirectToRoute('app_reservation_index');
    }

    #[Route('/{id}/decline', name: 'decline', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function decline(
        Request $request,
        Reservation $reservation,
        EntityManagerInterface $entityManager,
    ): RedirectResponse {
        $this->updateStatus($request, $reservation, $entityManager, 'DECLINED', 'decline');

        return $this->redirectToRoute('app_reservation_index');
    }

    private function updateStatus(
        Request $request,
        Reservation $reservation,
        EntityManagerInterface $entityManager,
        string $status,
        string $tokenAction,
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

        $this->addFlash('success', match (strtoupper($status)) {
            'APPROVED' => 'hotel_page.flash.reservation_approved',
            'DECLINED' => 'hotel_page.flash.reservation_declined',
            default => 'hotel_page.flash.reservation_updated',
        });
    }
}
