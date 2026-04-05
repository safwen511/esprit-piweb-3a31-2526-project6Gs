<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/reservations')]
final class ReservationUserController extends AbstractController
{
    #[Route('/check', name: 'app_reservation_check', methods: ['GET'])]
    public function check(Request $request, ReservationRepository $reservationRepository): Response
    {
        $clientId = $request->query->get('client_id', 1);

        $reservations = $reservationRepository->findBy(['clientId' => $clientId]);

        return $this->render('reservation_user/check.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/{id}/cancel', name: 'app_reservation_user_cancel', methods: ['POST'])]
    public function cancel(int $id, ReservationRepository $reservationRepository, EntityManagerInterface $entityManager): Response
    {
        $reservation = $reservationRepository->find($id);
        
        if (!$reservation) {
            throw $this->createNotFoundException('Reservation not found');
        }
        
        $reservation->setStatus('cancelled');
        $entityManager->flush();

        return $this->redirectToRoute('app_reservation_check', ['client_id' => 1]);
    }
}