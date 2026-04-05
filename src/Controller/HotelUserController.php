<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\Reservation;
use App\Repository\HotelRepository;
use App\Service\HotelApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/hotels')]
final class HotelUserController extends AbstractController
{
    public function __construct(
        private HotelApiService $hotelApiService
    ) {}

    #[Route(name: 'app_hotel_user_index', methods: ['GET'])]
    public function index(HotelRepository $hotelRepository): Response
    {
        $hotelsData = $this->hotelApiService->getAllHotelsDetails($hotelRepository->findAll());

        return $this->render('hotel_user/index.html.twig', [
            'hotels' => $hotelsData,
        ]);
    }

    #[Route('/{id}/book', name: 'app_hotel_user_book', methods: ['GET', 'POST'])]
    #[Route('/{id}/modify/{reservationId}', name: 'app_hotel_user_modify', methods: ['GET', 'POST'])]
    public function book(Request $request, int $id, int $reservationId = null, HotelRepository $hotelRepository, EntityManagerInterface $entityManager): Response
    {
        $hotel = $hotelRepository->find($id);
        
        if (!$hotel) {
            throw $this->createNotFoundException('Hotel not found');
        }
        
        $apiData = $this->hotelApiService->getHotelDetails($hotel->getName());
        $existingReservation = null;
        
        if ($reservationId) {
            $existingReservation = $entityManager->getRepository(Reservation::class)->find($reservationId);
        }
        
        $defaultValues = $existingReservation ? [
            'startDate' => $existingReservation->getStartDate()?->format('Y-m-d'),
            'endDate' => $existingReservation->getEndDate()?->format('Y-m-d'),
            'guestCount' => $existingReservation->getGuestCount(),
            'totalPrice' => $existingReservation->getTotalPrice(),
            'pricePerNight' => $existingReservation->getNightlyRate(),
            'reservationId' => $reservationId,
        ] : null;

        if ($request->isMethod('POST')) {
            $pricePerNight = (float)$request->request->get('pricePerNight');
            $startDate = new \DateTime($request->request->get('startDate'));
            $endDate = new \DateTime($request->request->get('endDate'));
            
            $nights = $endDate->diff($startDate)->days;
            $totalPrice = $nights * $pricePerNight;
            
            if ($existingReservation) {
                $existingReservation->setStartDate($startDate);
                $existingReservation->setEndDate($endDate);
                $existingReservation->setGuestCount((int)$request->request->get('guestCount'));
                $existingReservation->setNightlyRate((string)$pricePerNight);
                $existingReservation->setTotalPrice((string)$totalPrice);
                $existingReservation->setStatus('pending');
                $entityManager->flush();
            } else {
                $reservation = new Reservation();
                $reservation->setHotel($hotel);
                $reservation->setClientId(1);
                $reservation->setStartDate($startDate);
                $reservation->setEndDate($endDate);
                $reservation->setGuestCount((int)$request->request->get('guestCount'));
                $reservation->setReservationDate(new \DateTime());
                $reservation->setCreatedAt(new \DateTime());
                $reservation->setStatus('pending');
                $reservation->setNightlyRate((string)$pricePerNight);
                $reservation->setTotalPrice((string)$totalPrice);
                $entityManager->persist($reservation);
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_reservation_check', ['client_id' => 1]);
        }

        return $this->render('hotel_user/book.html.twig', [
            'hotel' => $hotel,
            'apiData' => $apiData,
            'defaultValues' => $defaultValues,
            'priceForDisplay' => $apiData['price'],
        ]);
    }
}
