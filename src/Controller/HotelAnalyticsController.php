<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Hotel;
use App\Repository\HotelRepository;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

#[IsGranted('ROLE_ADMIN')]
final class HotelAnalyticsController extends AbstractController
{
    #[Route('/admin/pet-hotels/analytics', name: 'app_hotel_analytics_index', methods: ['GET'])]
    public function index(
        Request $request,
        ReservationRepository $reservationRepository,
        HotelRepository $hotelRepository,
        TranslatorInterface $translator,
    ): Response {
        $selectedHotelId = max(0, $request->query->getInt('hotel'));
        $hotels = $hotelRepository->findAllOrdered();
        $selectedHotel = $selectedHotelId > 0 ? $hotelRepository->find($selectedHotelId) : null;
        $reservations = $selectedHotel instanceof Hotel
            ? $reservationRepository->findBy(['hotel' => $selectedHotel], ['createdAt' => 'DESC', 'id' => 'DESC'])
            : $reservationRepository->findAllOrdered();

        $scopeHotels = $selectedHotel instanceof Hotel ? [$selectedHotel] : $hotels;
        $totalCapacity = 0;

        foreach ($scopeHotels as $hotel) {
            $totalCapacity += max(0, $hotel->getCapacity());
        }

        if ($totalCapacity === 0) {
            $totalCapacity = max(count($scopeHotels), 1) * 10;
        }

        $stats = [
            'totalReservations' => count($reservations),
            'approvedReservations' => 0,
            'declinedReservations' => 0,
            'pendingReservations' => 0,
            'cancelledReservations' => 0,
            'totalHotels' => count($scopeHotels),
            'totalRevenue' => 0.0,
            'occupiedRooms' => 0,
            'availableRooms' => $totalCapacity,
        ];

        $revenueByHotel = [];
        $reservationStatusData = [
            'approved' => 0,
            'declined' => 0,
            'pending' => 0,
            'cancelled' => 0,
        ];

        foreach ($reservations as $reservation) {
            $normalizedStatus = strtoupper($reservation->getStatus());
            $hotelName = $reservation->getHotel()?->getName() ?? $translator->trans('hotel_page.labels.unknown_hotel');

            if (!array_key_exists($hotelName, $revenueByHotel)) {
                $revenueByHotel[$hotelName] = 0.0;
            }

            if ($normalizedStatus === 'APPROVED') {
                ++$stats['approvedReservations'];
                ++$reservationStatusData['approved'];
                $stats['occupiedRooms'] += max(1, $reservation->getGuestCount());
                $revenue = (float) $reservation->getTotalPrice();
                $stats['totalRevenue'] += $revenue;
                $revenueByHotel[$hotelName] += $revenue;
                continue;
            }

            if ($normalizedStatus === 'DECLINED') {
                ++$stats['declinedReservations'];
                ++$reservationStatusData['declined'];
                continue;
            }

            if ($normalizedStatus === 'CANCELLED') {
                ++$stats['cancelledReservations'];
                ++$reservationStatusData['cancelled'];
                continue;
            }

            ++$stats['pendingReservations'];
            ++$reservationStatusData['pending'];
        }

        $stats['availableRooms'] = max(0, $totalCapacity - $stats['occupiedRooms']);

        return $this->render('hotel_analytics/index.html.twig', [
            'stats' => $stats,
            'revenueLabels' => array_keys($revenueByHotel),
            'revenueValues' => array_values($revenueByHotel),
            'reservationStatusData' => array_values($reservationStatusData),
            'selectedHotel' => $selectedHotel,
            'allHotels' => $hotels,
        ]);
    }
}
