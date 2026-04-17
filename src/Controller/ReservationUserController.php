<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\User;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

#[IsGranted('ROLE_USER')]
final class ReservationUserController extends AbstractController
{
    public function __construct(
        private readonly TranslatorInterface $translator,
    ) {
    }

    #[Route('/pet-hotels/reservations', name: 'app_reservation_check', methods: ['GET'])]
    public function check(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation_user/check.html.twig', [
            'reservations' => $reservationRepository->findForClient($this->getCurrentUser()),
        ]);
    }

    #[Route('/pet-hotels/reservations/{id}/cancel', name: 'app_reservation_user_cancel', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function cancel(
        Request $request,
        Reservation $reservation,
        EntityManagerInterface $entityManager,
    ): RedirectResponse {
        $user = $this->getCurrentUser();

        if ($reservation->getClient()?->getId() !== $user->getId()) {
            throw $this->createAccessDeniedException($this->translator->trans('hotel_page.access.own_reservations_only'));
        }

        if (!$this->isCsrfTokenValid('cancel-reservation-'.$reservation->getId(), (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException($this->translator->trans('hotel_page.access.invalid_cancellation_request'));
        }

        $reservation->setStatus('CANCELLED');
        $entityManager->flush();

        $this->addFlash('success', 'hotel_page.flash.reservation_cancelled');

        return $this->redirectToRoute('app_reservation_check');
    }

    private function getCurrentUser(): User
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException($this->translator->trans('hotel_page.access.view_reservations'));
        }

        return $user;
    }
}
