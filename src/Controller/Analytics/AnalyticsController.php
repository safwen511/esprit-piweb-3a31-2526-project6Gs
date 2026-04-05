<?php

namespace App\Controller\Analytics;

use App\Repository\ReservationRepository;
use App\Repository\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/analytics')]
final class AnalyticsController extends AbstractController
{
    #[Route(name: 'app_analytics_index', methods: ['GET'])]
    public function index(Request $request, ReservationRepository $reservationRepo, HotelRepository $hotelRepo): Response
    {
        $selectedHotel = $request->query->get('hotel');

        if ($selectedHotel) {
            $hotels = $hotelRepo->findBy(['name' => $selectedHotel]);
            $hotelIds = array_map(fn($h) => $h->getId(), $hotels);
            $reservations = $reservationRepo->findBy(['hotel' => $hotelIds]);
        } else {
            $hotels = $hotelRepo->findAll();
            $reservations = $reservationRepo->findAll();
        }

        $stats = [
            'totalReservations' => count($reservations),
            'approvedReservations' => 0,
            'declinedReservations' => 0,
            'pendingReservations' => 0,
            'totalHotels' => count($hotels),
            'totalRevenue' => 0,
            'occupiedRooms' => 0,
            'availableRooms' => 0,
        ];

        $revenueByHotel = [];
        $reservationStatusData = [0, 0, 0];

        foreach ($reservations as $res) {
            $status = $res->getStatus() ?? 'PENDING';
            
            if ($status === 'APPROVED') {
                $stats['approvedReservations']++;
                $stats['occupiedRooms'] += $res->getGuestCount() ?? 1;
                $stats['totalRevenue'] += floatval($res->getTotalPrice() ?? 0);
                
                $hotelNameLoop = $res->getHotel()?->getName() ?? 'Unknown';
                if (!isset($revenueByHotel[$hotelNameLoop])) {
                    $revenueByHotel[$hotelNameLoop] = 0;
                }
                $revenueByHotel[$hotelNameLoop] += floatval($res->getTotalPrice() ?? 0);
                
                $reservationStatusData[0]++;
            } elseif ($status === 'DECLINED') {
                $stats['declinedReservations']++;
                $reservationStatusData[1]++;
            } else {
                $stats['pendingReservations']++;
                $reservationStatusData[2]++;
            }
        }

        $stats['availableRooms'] = max(0, ($stats['totalHotels'] * 10) - $stats['occupiedRooms']);

        $revenueLabels = array_keys($revenueByHotel);
        $revenueValues = array_values($revenueByHotel);

        $allHotels = $hotelRepo->findAll();

        return $this->render('analytics/index.html.twig', [
            'stats' => $stats,
            'revenueLabels' => $revenueLabels,
            'revenueValues' => $revenueValues,
            'reservationStatusData' => $reservationStatusData,
            'selectedHotel' => $selectedHotel,
            'allHotels' => $allHotels,
        ]);
    }
}