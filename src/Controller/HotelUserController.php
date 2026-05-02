<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Hotel;
use App\Entity\Reservation;
use App\Entity\User;
use App\Repository\AnimalRepository;
use App\Repository\HotelRepository;
use App\Repository\ReservationRepository;
use App\Service\HotelApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

#[IsGranted('ROLE_USER')]
#[Route('/pet-hotels', name: 'app_hotel_user_')]
final class HotelUserController extends AbstractController
{
    public function __construct(
        private readonly HotelApiService $hotelApiService,
        private readonly TranslatorInterface $translator,
    ) {
    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(HotelRepository $hotelRepository): Response
    {
        return $this->render('hotel_user/index.html.twig', [
            'hotels' => $this->hotelApiService->buildHotelCards($hotelRepository->findAllOrdered()),
        ]);
    }

    #[Route('/{id}/book', name: 'book', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    #[Route('/{id}/booking/{reservationId}', name: 'modify', requirements: ['id' => '\d+', 'reservationId' => '\d+'], methods: ['GET', 'POST'])]
    public function book(
        Request $request,
        Hotel $hotel,
        AnimalRepository $animalRepository,
        ReservationRepository $reservationRepository,
        EntityManagerInterface $entityManager,
        ?int $reservationId = null,
    ): Response|RedirectResponse {
        $user = $this->getCurrentUser();
        $reservation = null;

        if ($reservationId !== null) {
            $reservation = $reservationRepository->find($reservationId);

            if (!$reservation instanceof Reservation || $reservation->getClient()?->getId() !== $user->getId() || $reservation->getHotel()?->getId() !== $hotel->getId()) {
                throw $this->createNotFoundException($this->translator->trans('hotel_page.access.reservation_not_found'));
            }
        }

        $animals = $animalRepository->findByOwner($user);
        $hotelDetails = $this->hotelApiService->getHotelDetails((string) $hotel->getName());
        $capacityLimit = $hotel->getCapacity() > 0 ? $hotel->getCapacity() : 10;
        $formData = [
            'startDate' => $reservation?->getStartDate()?->format('Y-m-d') ?? '',
            'endDate' => $reservation?->getEndDate()?->format('Y-m-d') ?? '',
            'guestCount' => (string) ($reservation?->getGuestCount() ?? 1),
            'animalId' => (string) ($reservation?->getAnimalId() ?? ''),
            'pricePerNight' => $reservation?->getNightlyRate() ?? number_format($hotelDetails['price'], 2, '.', ''),
        ];
        $errors = [];

        if ($request->isMethod('POST')) {
            $formData = [
                'startDate' => trim((string) $request->request->get('startDate', '')),
                'endDate' => trim((string) $request->request->get('endDate', '')),
                'guestCount' => trim((string) $request->request->get('guestCount', '1')),
                'animalId' => trim((string) $request->request->get('animalId', '')),
                'pricePerNight' => trim((string) $request->request->get('pricePerNight', $formData['pricePerNight'])),
            ];

            $startDate = $this->parseDate($formData['startDate']);
            $endDate = $this->parseDate($formData['endDate']);
            $animal = $this->resolveOwnedAnimal($formData['animalId'], $animals);

            if (!$startDate instanceof \DateTimeImmutable) {
                $errors[] = ['message' => 'hotel_page.booking.errors.invalid_check_in'];
            }

            if (!$endDate instanceof \DateTimeImmutable) {
                $errors[] = ['message' => 'hotel_page.booking.errors.invalid_check_out'];
            }

            if ($startDate instanceof \DateTimeImmutable && $endDate instanceof \DateTimeImmutable && $endDate <= $startDate) {
                $errors[] = ['message' => 'hotel_page.booking.errors.invalid_date_range'];
            }

            if (!ctype_digit($formData['guestCount']) || (int) $formData['guestCount'] < 1) {
                $errors[] = ['message' => 'hotel_page.booking.errors.min_guests'];
            }

            if (ctype_digit($formData['guestCount']) && $hotel->getCapacity() > 0 && (int) $formData['guestCount'] > $hotel->getCapacity()) {
                $errors[] = [
                    'message' => 'hotel_page.booking.errors.capacity_exceeded',
                    'parameters' => ['%capacity%' => $hotel->getCapacity()],
                ];
            }

            if ($formData['animalId'] !== '' && !$animal instanceof Animal) {
                $errors[] = ['message' => 'hotel_page.booking.errors.invalid_pet'];
            }

            if (!is_numeric($formData['pricePerNight']) || (float) $formData['pricePerNight'] <= 0) {
                $errors[] = ['message' => 'hotel_page.booking.errors.invalid_rate'];
            }

            if ($errors === []) {
                if ($endDate === null) {
                    throw new \LogicException('Validated reservation dates should be available.');
                }

                $nights = (int) $startDate->diff($endDate)->days;
                $nightlyRate = round((float) $formData['pricePerNight'], 2);
                $totalPrice = round($nightlyRate * $nights, 2);

                $reservation ??= new Reservation();
                $reservation
                    ->setHotel($hotel)
                    ->setClient($user)
                    ->setAnimal($animal)
                    ->setStartDate(\DateTime::createFromImmutable($startDate))
                    ->setEndDate(\DateTime::createFromImmutable($endDate))
                    ->setGuestCount((int) $formData['guestCount'])
                    ->setStatus('PENDING')
                    ->setNightlyRate(number_format($nightlyRate, 2, '.', ''))
                    ->setTotalPrice(number_format($totalPrice, 2, '.', ''));

                if ($reservation->getId() === null) {
                    $reservation
                        ->setCreatedAt(new \DateTime())
                        ->setReservationDate(new \DateTime('today'));
                    $entityManager->persist($reservation);
                }

                $entityManager->flush();
                $this->addFlash('success', $reservationId === null ? 'hotel_page.flash.booking_created' : 'hotel_page.flash.booking_updated');

                return $this->redirectToRoute('app_reservation_check');
            }
        }

        return $this->render('hotel_user/book.html.twig', [
            'hotel' => $hotel,
            'hotelDetails' => $hotelDetails,
            'reservation' => $reservation,
            'animals' => $animals,
            'formData' => $formData,
            'errors' => $errors,
            'capacityLimit' => $capacityLimit,
        ]);
    }

    /**
     * @param Animal[] $animals
     */
    private function resolveOwnedAnimal(string $animalId, array $animals): ?Animal
    {
        if ($animalId === '' || !ctype_digit($animalId)) {
            return null;
        }

        foreach ($animals as $animal) {
            if ($animal->getId() === (int) $animalId) {
                return $animal;
            }
        }

        return null;
    }

    private function parseDate(string $value): ?\DateTimeImmutable
    {
        if ($value === '') {
            return null;
        }

        $date = \DateTimeImmutable::createFromFormat('Y-m-d', $value);

        if (!$date instanceof \DateTimeImmutable || $date->format('Y-m-d') !== $value) {
            return null;
        }

        return $date;
    }

    private function getCurrentUser(): User
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException($this->translator->trans('hotel_page.access.access_hotels'));
        }

        return $user;
    }
}
