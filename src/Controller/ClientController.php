<?php
namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Disponibilite;
use App\Entity\Rendezvous;
use App\Entity\Review;
use App\Entity\User;
use App\Repository\ReviewRepository;
use App\Service\AppointmentAiAssistantService;
use App\Service\AppointmentNotificationService;
use App\Service\MailService;
use App\Service\VetAIRankingService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/client')]
class ClientController extends AbstractController
{
    #[Route('/veterinaires', name: 'client_vet_list')]
    public function listVets(
        EntityManagerInterface $em,
        ReviewRepository $reviewRepo
    ): Response {
        $client = $this->getUser();
$vets = $em->getRepository(User::class)->createQueryBuilder('u')
    ->where('u.roles LIKE :role')
    ->setParameter('role', '%VETERINAIRE%')
    ->getQuery()
    ->getResult();
        $vetsAvecStats = array_map(function ($vet) use ($reviewRepo, $em, $client) {
            $rdvConfirme = $em->getRepository(Rendezvous::class)->findOneBy([
                'client' => $client,
                'vet' => $vet,
                'status' => 'confirmed',
            ]);

            $dejaAvis = $reviewRepo->findOneBy([
                'client' => $client,
                'vet' => $vet,
            ]);

            return [
                'vet' => $vet,
                'stats' => $reviewRepo->getStatsParVet($vet->getId()),
                'peutDonnerAvis' => $rdvConfirme !== null && $dejaAvis === null,
            ];
        }, $vets);

        return $this->render('client/veterinaires.html.twig', [
            'vetsAvecStats' => $vetsAvecStats,
        ]);
    }

    #[Route('/review/submit', name: 'client_review_submit', methods: ['POST'])]
    public function submitReview(
        Request $request,
        EntityManagerInterface $em,
        ReviewRepository $reviewRepo,
        TranslatorInterface $translator,
    ): JsonResponse {
        $locale = $request->getLocale();
        $client = $this->getUser();
        $data = json_decode($request->getContent(), true);
        $vetId = $data['vet_id'] ?? null;
        $note = (int) ($data['note'] ?? 0);

        if (!$vetId || $note < 1 || $note > 5) {
            return $this->json([
                'success' => false,
                'message' => $translator->trans('appointments.directory.review_invalid_data', [], null, $locale),
            ]);
        }

        $vet = $em->getRepository(User::class)->find($vetId);

        $rdvConfirme = $em->getRepository(Rendezvous::class)->findOneBy([
            'client' => $client,
            'vet' => $vet,
            'status' => 'confirmed',
        ]);

        if (!$rdvConfirme) {
            return $this->json([
                'success' => false,
                'message' => $translator->trans('appointments.directory.review_no_confirmed', [], null, $locale),
            ]);
        }

        $dejaAvis = $reviewRepo->findOneBy(['client' => $client, 'vet' => $vet]);
        if ($dejaAvis) {
            return $this->json([
                'success' => false,
                'message' => $translator->trans('appointments.directory.review_already_left', [], null, $locale),
            ]);
        }

        $review = new Review();
        $review->setVet($vet);
        $review->setClient($client);
        $review->setNote($note);
        $review->setCommentaire($data['commentaire'] ?? null);
        $review->setCreatedAt(new \DateTime());

        $em->persist($review);
        $em->flush();

        return $this->json(['success' => true]);
    }

    #[Route('/veterinaires/top3-ia', name: 'client_vet_top3', methods: ['POST'])]
    public function top3IA(
        Request $request,
        EntityManagerInterface $em,
        ReviewRepository $reviewRepo,
        VetAIRankingService $aiService,
        TranslatorInterface $translator,
    ): JsonResponse {
        $locale = $request->getLocale();
        $vets = $em->getRepository(User::class)->createQueryBuilder('u')
            ->where('u.roles LIKE :role')
            ->setParameter('role', '%VETERINAIRE%')
            ->getQuery()
            ->getResult();

        $vetsAvecStats = array_map(function ($vet) use ($reviewRepo) {
            return [
                'vet' => $vet,
                'stats' => $reviewRepo->getStatsParVet($vet->getId()),
            ];
        }, $vets);

        $totalAvis = array_sum(array_column(
            array_column($vetsAvecStats, 'stats'),
            'nombre_avis'
        ));

        if ($totalAvis === 0) {
            return $this->json([
                'top3' => [],
                'message' => $translator->trans('appointments.directory.top3_empty', [], null, $locale),
            ]);
        }

        try {
            $result = $aiService->getTop3($vetsAvecStats);
            $top3Detailed = [];

            foreach ($result['top3'] ?? [] as $rankedVet) {
                $matched = $this->findVetMatch($rankedVet, $vetsAvecStats);
                if ($matched === null) {
                    continue;
                }

                $top3Detailed[] = [
                    'id' => $matched['vet']->getId(),
                    'nom' => sprintf('Dr. %s %s', $matched['vet']->getFirstName(), $matched['vet']->getLastName()),
                    'initiales' => strtoupper(substr((string) $matched['vet']->getFirstName(), 0, 1) . substr((string) $matched['vet']->getLastName(), 0, 1)),
                    'justification' => (string) ($rankedVet['justification'] ?? ''),
                    'stats' => $matched['stats'],
                ];
            }
        } catch (\Throwable) {
            return $this->json([
                'top3' => [],
                'message' => $translator->trans('appointments.directory.top3_error', [], null, $locale),
            ]);
        }

        return $this->json(['top3' => $top3Detailed]);
    }

    #[Route('/veterinaire/{id}/rdv', name: 'client_prendre_rdv')]
    public function prendreRdv(
        int $id,
        Request $request,
        EntityManagerInterface $em,
        MailService $mailService,
        AppointmentNotificationService $appointmentNotificationService,
    ): Response
    {
        $vet = $em->getRepository(User::class)->find($id);
        $client = $this->getUser();
        $locale = $request->getLocale();

        if (!$vet instanceof User) {
            throw $this->createNotFoundException('Veterinarian not found.');
        }

        $dispos = $em->getRepository(Disponibilite::class)->findBy(
            ['vet' => $vet, 'isAvailable' => true],
            ['date' => 'ASC', 'startTime' => 'ASC']
        );

        $creneauxByDate = [];
        foreach ($dispos as $dispo) {
            $dateKey = $dispo->getDate()->format('Y-m-d');
            $start = clone $dispo->getStartTime();
            $end = clone $dispo->getEndTime();

            while (true) {
                $slotEnd = clone $start;
                $slotEnd->modify('+1 hour');
                if ($slotEnd > $end) {
                    break;
                }

                $alreadyBooked = $em->getRepository(Rendezvous::class)->findOneBy([
                    'vet' => $vet,
                    'appointmentDate' => $dispo->getDate(),
                    'appointmentTime' => $start,
                ]);

                if (!$alreadyBooked) {
                    $creneauxByDate[$dateKey][] = [
                        'dispo_id' => $dispo->getId(),
                        'date' => $dispo->getDate()->format('d/m/Y'),
                        'start' => $start->format('H:i'),
                        'end' => $slotEnd->format('H:i'),
                        'start_raw' => $start->format('H:i'),
                    ];
                }
                $start->modify('+1 hour');
            }
        }

        $animals = $em->getRepository(Animal::class)->findBy(['owner' => $client]);

        if ($request->isMethod('POST')) {
            $dispoId = $request->request->get('disponibilite_id');
            $slotTime = $request->request->get('slot_time');
            $animalId = $request->request->get('animal_id');
            $description = $request->request->get('description');
            $phone = $request->request->get('phone');
            $newAnimalName = $request->request->get('new_animal_name');
            $newAnimalSpecies = $request->request->get('new_animal_species');

            $dispo = $em->getRepository(Disponibilite::class)->find($dispoId);

            if (!$dispo || !$dispo->isAvailable()) {
                $this->addFlash('danger', 'appointments.flash.slot_unavailable');

                return $this->redirectToRoute('client_prendre_rdv', ['id' => $id]);
            }

            if ($newAnimalName && $newAnimalSpecies) {
                $animal = new Animal();
                $animal->setName($newAnimalName);
                $animal->setType($newAnimalSpecies);
                $animal->setStatus('UNAVAILABLE');
                $animal->setOwner($client);
                $em->persist($animal);
            } else {
                $animal = $em->getRepository(Animal::class)->find($animalId);
            }

            if (!$animal) {
                $this->addFlash('danger', 'appointments.flash.choose_animal');

                return $this->redirectToRoute('client_prendre_rdv', ['id' => $id]);
            }

            if ($phone) {
                $client->setPhone($phone);
            }

            $appointmentTime = \DateTime::createFromFormat('H:i', $slotTime);
            if (!$appointmentTime instanceof \DateTime) {
                $this->addFlash('danger', 'appointments.flash.invalid_time');

                return $this->redirectToRoute('client_prendre_rdv', ['id' => $id]);
            }

            $alreadyBooked = $em->getRepository(Rendezvous::class)->findOneBy([
                'vet' => $vet,
                'appointmentDate' => $dispo->getDate(),
                'appointmentTime' => $appointmentTime,
            ]);

            if ($alreadyBooked !== null) {
                $this->addFlash('danger', 'appointments.flash.slot_unavailable');

                return $this->redirectToRoute('client_prendre_rdv', ['id' => $id]);
            }

            $rdv = new Rendezvous();
            $rdv->setVet($vet);
            $rdv->setClient($client);
            $rdv->setAnimal($animal);
            $rdv->setDisponibilite($dispo);
            $rdv->setAppointmentDate($dispo->getDate());
            $rdv->setAppointmentTime($appointmentTime);
            $rdv->setDescription($description);
            $rdv->setStatus('pending');

            $em->persist($rdv);
            $appointmentNotificationService->notifyVetRequest($vet, $client, $animal, $rdv, $locale);
            $em->flush();

            $vetMailSent = false;
            try {
                if ($vet->getEmail()) {
                    $mailService->sendRdvNotificationToVet(
                        $vet->getEmail(),
                        $vet->getFirstName() . ' ' . $vet->getLastName(),
                        $client->getFirstName() . ' ' . $client->getLastName(),
                        $dispo->getDate()->format('d/m/Y'),
                        $appointmentTime->format('H:i'),
                        $animal->getName(),
                        $animal->getType(),
                        $phone ?: $client->getPhone(),
                        $description,
                        $locale,
                    );
                    $vetMailSent = true;
                }
            } catch (\Throwable) {
            }

            $this->addFlash($vetMailSent ? 'success' : 'warning', $vetMailSent
                ? 'appointments.flash.request_created_vet_notified'
                : 'appointments.flash.request_created_email_failed'
            );

            return $this->redirectToRoute('client_mes_rdv');
        }

        return $this->render('client/prendre_rdv.html.twig', [
            'vet' => $vet,
            'creneauxByDate' => $creneauxByDate,
            'animals' => $animals,
        ]);
    }

    #[Route('/veterinaire/{id}/rdv/ai-helper', name: 'client_prendre_rdv_ai', methods: ['POST'])]
    public function bookingAiHelper(
        int $id,
        Request $request,
        EntityManagerInterface $em,
        AppointmentAiAssistantService $appointmentAiAssistantService,
        TranslatorInterface $translator,
    ): JsonResponse {
        $vet = $em->getRepository(User::class)->find($id);
        if (!$vet instanceof User) {
            return $this->json([
                'success' => false,
                'message' => $translator->trans('appointments.ai.error', [], null, $request->getLocale()),
            ], Response::HTTP_NOT_FOUND);
        }

        if (!$this->isCsrfTokenValid('appointment_ai_assist', (string) $request->headers->get('X-CSRF-TOKEN'))) {
            return $this->json([
                'success' => false,
                'message' => $translator->trans('appointments.ai.error', [], null, $request->getLocale()),
            ], Response::HTTP_FORBIDDEN);
        }

        try {
            $payload = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return $this->json([
                'success' => false,
                'message' => $translator->trans('appointments.ai.error', [], null, $request->getLocale()),
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!is_array($payload)) {
            return $this->json([
                'success' => false,
                'message' => $translator->trans('appointments.ai.error', [], null, $request->getLocale()),
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $result = $appointmentAiAssistantService->assistBookingRequest(
                (string) ($payload['description'] ?? ''),
                ($payload['animal_name'] ?? null) !== '' ? (string) $payload['animal_name'] : null,
                ($payload['animal_type'] ?? null) !== '' ? (string) $payload['animal_type'] : null,
                $request->getLocale(),
            );
        } catch (\InvalidArgumentException $exception) {
            return $this->json([
                'success' => false,
                'message' => $translator->trans($exception->getMessage(), [], null, $request->getLocale()),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Throwable) {
            $result = $appointmentAiAssistantService->buildLocalSuggestion(
                (string) ($payload['description'] ?? ''),
                ($payload['animal_name'] ?? null) !== '' ? (string) $payload['animal_name'] : null,
                ($payload['animal_type'] ?? null) !== '' ? (string) $payload['animal_type'] : null,
                $request->getLocale(),
            );
        }

        return $this->json([
            'success' => true,
            'suggested_note' => $result['suggested_note'],
            'intake_summary' => $result['intake_summary'],
            'checklist' => $result['checklist'],
        ]);
    }

    #[Route('/mes-rendezvous', name: 'client_mes_rdv')]
    public function mesRdv(EntityManagerInterface $em): Response
    {
        $client = $this->getUser();
        $rdvs = $em->getRepository(Rendezvous::class)->findBy(['client' => $client]);

        $stats = [
            'pending' => 0,
            'confirmed' => 0,
            'cancelled' => 0,
        ];

        foreach ($rdvs as $rdv) {
            if (isset($stats[$rdv->getStatus()])) {
                ++$stats[$rdv->getStatus()];
            }
        }

        return $this->render('client/mes_rendezvous.html.twig', [
            'rdvs' => $rdvs,
            'stats' => $stats,
        ]);
    }

    #[Route('/rendezvous/{id}/annuler', name: 'client_rdv_annuler', methods: ['POST'])]
    public function annulerRdv(int $id, EntityManagerInterface $em): Response
    {
        $rdv = $em->getRepository(Rendezvous::class)->find($id);
        $rdv->setStatus('cancelled');

        $dispo = $rdv->getDisponibilite();
        if ($dispo) {
            $dispo->setIsAvailable(true);
        }

        $em->flush();
        $this->addFlash('info', 'appointments.flash.request_cancelled');

        return $this->redirectToRoute('client_mes_rdv');
    }

    private function findVetMatch(array $rankedVet, array $vetsAvecStats): ?array
    {
        $normalizedTarget = $this->normalizeVetName((string) ($rankedVet['nom'] ?? ''));

        foreach ($vetsAvecStats as $item) {
            $candidate = sprintf('Dr. %s %s', $item['vet']->getFirstName(), $item['vet']->getLastName());
            if ($this->normalizeVetName($candidate) === $normalizedTarget) {
                return $item;
            }
        }

        return null;
    }

    private function normalizeVetName(string $value): string
    {
        $value = mb_strtolower(trim($value));
        $value = str_replace(['dr.', 'dr', 'docteur'], '', $value);
        $value = preg_replace('/\s+/', ' ', $value);

        return trim((string) $value);
    }
}
