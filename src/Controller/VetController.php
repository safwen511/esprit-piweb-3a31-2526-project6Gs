<?php
namespace App\Controller;

use App\Entity\Disponibilite;
use App\Entity\Rendezvous;
use App\Entity\User;
use App\Entity\VetPlanningEvent;
use App\Form\DisponibiliteType;
use App\Form\VetPlanningEventType;
use App\Repository\ReviewRepository;
use App\Service\AppointmentNotificationService;
use App\Service\MailService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/vet')]
class VetController extends AbstractController
{
    #[Route('', name: 'vet_dashboard')]
    public function dashboard(
        Request $request,
        EntityManagerInterface $em,
        ReviewRepository $reviewRepository,
        PaginatorInterface $paginator
    ): Response {
        $vet = $this->getVetUser();

        $pendingRows = $em->getConnection()->fetchAllAssociative(
            'SELECT r.id_rdv AS id,
                    r.appointment_date AS appointmentDate,
                    r.appointment_time AS appointmentTime,
                    (SELECT a.name FROM animal a WHERE a.idAnimal = r.animal_id) AS animalName,
                    (SELECT a.species FROM animal a WHERE a.idAnimal = r.animal_id) AS animalType,
                    (SELECT u.first_name FROM user u WHERE u.id = r.client_id) AS clientFirstName,
                    (SELECT u.last_name FROM user u WHERE u.id = r.client_id) AS clientLastName
             FROM rendezvous r
             WHERE r.vet_id = :vetId AND r.status = :status
             ORDER BY r.appointment_date ASC, r.appointment_time ASC',
            [
                'vetId' => (int) $vet->getId(),
                'status' => 'pending',
            ],
        );

        $pendingRequests = $paginator->paginate(
            $pendingRows,
            $request->query->getInt('pendingPage', 1),
            5,
            ['pageParameterName' => 'pendingPage']
        );

        return $this->render('vet/dashboard.html.twig', [
            'vet' => $vet,
            'stats' => $this->buildVetStats($em, $reviewRepository, $vet),
            'pendingRequests' => $pendingRequests,
        ]);
    }

    #[Route('/planning', name: 'vet_calendar')]
    public function calendar(Request $request, EntityManagerInterface $em): Response
    {
        $vet = $this->getVetUser();
        $planningEvent = new VetPlanningEvent();
        $planningEvent->setVet($vet);

        $form = $this->createForm(VetPlanningEventType::class, $planningEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($planningEvent->getEndsAt() !== null && $planningEvent->getEndsAt() < $planningEvent->getStartsAt()) {
                $this->addFlash('danger', 'La date de fin doit etre apres la date de debut.');
            } else {
                $em->persist($planningEvent);
                $em->flush();
                $this->addFlash('success', 'Evenement ajoute au planning.');

                return $this->redirectToRoute('vet_calendar');
            }
        }

        $planningEvents = $em->createQueryBuilder()
            ->select('e')
            ->from(VetPlanningEvent::class, 'e')
            ->where('e.vet = :vet')
            ->setParameter('vet', $vet)
            ->orderBy('e.startsAt', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('vet/calendar.html.twig', [
            'form' => $form->createView(),
            'planningEvents' => $planningEvents,
        ]);
    }

    #[Route('/planning/{id}/delete', name: 'vet_calendar_delete', methods: ['POST'])]
    public function deletePlanningEvent(int $id, EntityManagerInterface $em): Response
    {
        $deleted = $em->createQueryBuilder()
            ->delete(VetPlanningEvent::class, 'e')
            ->where('e.id = :id')
            ->andWhere('e.vet = :vet')
            ->setParameter('id', $id)
            ->setParameter('vet', $this->getVetUser())
            ->getQuery()
            ->execute();

        if ($deleted < 1) {
            $this->addFlash('danger', 'Evenement introuvable.');

            return $this->redirectToRoute('vet_calendar');
        }
        $this->addFlash('success', 'Evenement supprime.');

        return $this->redirectToRoute('vet_calendar');
    }

    #[Route('/disponibilites', name: 'vet_dispos')]
    public function mesDispos(
        Request $request,
        EntityManagerInterface $em,
        PaginatorInterface $paginator
    ): Response {
        $vet = $this->getVetUser();

        $dispoRows = $em->getConnection()->fetchAllAssociative(
            'SELECT id_disponibilite AS id,
                    date,
                    start_time AS startTime,
                    end_time AS endTime,
                    is_available AS available
             FROM disponibilite
             WHERE vet_id = :vetId
             ORDER BY date DESC, start_time DESC',
            ['vetId' => (int) $vet->getId()],
        );

        $dispos = $paginator->paginate(
            $dispoRows,
            $request->query->getInt('page', 1),
            8
        );

        return $this->render('vet/disponibilites.html.twig', [
            'dispos' => $dispos,
            'vet' => $vet,
        ]);
    }

    #[Route('/disponibilite/new', name: 'vet_dispo_new')]
    public function newDispo(Request $request, EntityManagerInterface $em): Response
    {
        $vet = $this->getVetUser();
        $dispo = new Disponibilite();
        $dispo->setVet($vet);
        $dispo->setIsAvailable(true);

        $form = $this->createForm(DisponibiliteType::class, $dispo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conflict = $em->getRepository(Disponibilite::class)->findOneBy([
                'vet' => $vet,
                'date' => $dispo->getDate(),
                'startTime' => $dispo->getStartTime(),
            ]);

            if ($conflict) {
                $this->addFlash('danger', 'Un creneau existe deja a cette date et heure.');

                return $this->render('vet/dispo_form.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

            $em->persist($dispo);
            $em->flush();

            $this->addFlash('success', 'Disponibilite ajoutee.');

            return $this->redirectToRoute('vet_dispos');
        }

        return $this->render('vet/dispo_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/disponibilite/{id}/edit', name: 'vet_dispo_edit')]
    public function editDispo(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $dispo = $em->getRepository(Disponibilite::class)->find($id);

        if (!$dispo) {
            $this->addFlash('danger', 'Disponibilite introuvable.');

            return $this->redirectToRoute('vet_dispos');
        }

        $this->denyAccessUnlessVetOwnsDispo($dispo);

        $form = $this->createForm(DisponibiliteType::class, $dispo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Disponibilite modifiee.');

            return $this->redirectToRoute('vet_dispos');
        }

        return $this->render('vet/dispo_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/disponibilite/{id}/delete', name: 'vet_dispo_delete', methods: ['POST'])]
    public function deleteDispo(int $id, EntityManagerInterface $em): Response
    {
        $vet = $this->getVetUser();
        $exists = (int) $em->createQueryBuilder()
            ->select('COUNT(d.id)')
            ->from(Disponibilite::class, 'd')
            ->where('d.id = :id')
            ->andWhere('d.vet = :vet')
            ->setParameter('id', $id)
            ->setParameter('vet', $vet)
            ->getQuery()
            ->getSingleScalarResult();

        if ($exists < 1) {
            $this->addFlash('danger', 'Disponibilite introuvable.');

            return $this->redirectToRoute('vet_dispos');
        }

        $rdvCount = (int) $em->createQueryBuilder()
            ->select('COUNT(r.id)')
            ->from(Rendezvous::class, 'r')
            ->where('r.disponibilite = :dispo')
            ->setParameter('dispo', $em->getReference(Disponibilite::class, $id))
            ->getQuery()
            ->getSingleScalarResult();

        if ($rdvCount > 0) {
            $this->addFlash('danger', 'Impossible de supprimer ce creneau car des rendez-vous y sont lies.');

            return $this->redirectToRoute('vet_dispos');
        }

        $em->createQueryBuilder()
            ->delete(Disponibilite::class, 'd')
            ->where('d.id = :id')
            ->andWhere('d.vet = :vet')
            ->setParameter('id', $id)
            ->setParameter('vet', $vet)
            ->getQuery()
            ->execute();

        $this->addFlash('success', 'Disponibilite supprimee.');

        return $this->redirectToRoute('vet_dispos');
    }

    #[Route('/rendezvous', name: 'vet_rdv_list')]
    public function mesRdv(
        Request $request,
        EntityManagerInterface $em,
        ReviewRepository $reviewRepository,
        PaginatorInterface $paginator
    ): Response {
        $vet = $this->getVetUser();
        $status = trim((string) $request->query->get('status', ''));
        $search = trim((string) $request->query->get('search', ''));

        $where = ['r.vet_id = :vetId'];
        $params = ['vetId' => (int) $vet->getId()];

        if ($status !== '') {
            $where[] = 'r.status = :status';
            $params['status'] = $status;
        }

        if ($search !== '') {
            $where[] = '(
                (SELECT u.first_name FROM user u WHERE u.id = r.client_id) LIKE :search
                OR (SELECT u.last_name FROM user u WHERE u.id = r.client_id) LIKE :search
                OR (SELECT a.name FROM animal a WHERE a.idAnimal = r.animal_id) LIKE :search
            )';
            $params['search'] = '%' . $search . '%';
        }

        $rdvRows = $em->getConnection()->fetchAllAssociative(
            'SELECT r.id_rdv AS id,
                    r.appointment_date AS appointmentDate,
                    r.appointment_time AS appointmentTime,
                    r.status AS status,
                    r.description AS description,
                    (SELECT a.name FROM animal a WHERE a.idAnimal = r.animal_id) AS animalName,
                    (SELECT a.species FROM animal a WHERE a.idAnimal = r.animal_id) AS animalType,
                    (SELECT u.first_name FROM user u WHERE u.id = r.client_id) AS clientFirstName,
                    (SELECT u.last_name FROM user u WHERE u.id = r.client_id) AS clientLastName,
                    (SELECT COALESCE(u.phone, u.phone_number) FROM user u WHERE u.id = r.client_id) AS clientPhone
             FROM rendezvous r
             WHERE ' . implode(' AND ', $where) . '
             ORDER BY r.appointment_date DESC, r.appointment_time DESC',
            $params,
        );

        $rdvs = $paginator->paginate(
            $rdvRows,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('vet/rendezvous.html.twig', [
            'rdvs' => $rdvs,
            'status' => $status,
            'search' => $search,
            'stats' => $this->buildVetStats($em, $reviewRepository, $vet),
        ]);
    }

    #[Route('/rendezvous/{id}/accept', name: 'vet_rdv_accept', methods: ['POST'])]
    public function acceptRdv(
        int $id,
        Request $request,
        EntityManagerInterface $em,
        MailService $mailService,
        AppointmentNotificationService $appointmentNotificationService,
        LoggerInterface $logger,
    ): Response
    {
        $rdv = $em->getRepository(Rendezvous::class)->find($id);

        if (!$rdv) {
            $this->addFlash('danger', 'appointments.vet_queue.flash.not_found');

            return $this->redirectToRoute('vet_rdv_list');
        }

        $this->denyAccessUnlessVetOwnsRdv($rdv);

        if ($rdv->getStatus() !== 'pending') {
            $this->addFlash('danger', 'appointments.vet_queue.flash.accept_pending_only');

            return $this->redirectToRoute('vet_rdv_list');
        }

        $rdv->setStatus('confirmed');

        $this->updateRdvDisponibiliteAvailability($em, $rdv, false);

        $client = $rdv->getClient();
        $vet = $rdv->getVet();
        if ($client && $vet) {
            $appointmentNotificationService->notifyClientConfirmed($client, $vet, $rdv, $request->getLocale());
        }

        $em->flush();

        $mailSent = true;

        if ($client && $client->getEmail()) {
            try {
                $mailService->sendConfirmationRdv(
                    $client->getEmail(),
                    trim(($client->getFirstName() ?? '') . ' ' . ($client->getLastName() ?? '')),
                    ($rdv->getAppointmentDate()?->format('d/m/Y')) ?? '',
                    ($rdv->getAppointmentTime()?->format('H:i')) ?? '',
                    trim(($vet?->getFirstName() ?? '') . ' ' . ($vet?->getLastName() ?? '')),
                    $request->getLocale(),
                );
            } catch (\Throwable $exception) {
                $mailSent = false;
                $logger->error('Unable to send appointment confirmation email to client.', [
                    'appointment_id' => $rdv->getId(),
                    'client_id' => $client->getId(),
                    'client_email' => $client->getEmail(),
                    'exception' => $exception,
                ]);
            }
        }

        $this->addFlash(
            'success',
            $mailSent
                ? 'appointments.vet_queue.flash.accepted_mail_sent'
                : 'appointments.vet_queue.flash.accepted_mail_failed'
        );

        return $this->redirectToRoute('vet_rdv_list');
    }

    #[Route('/rendezvous/{id}/refuse', name: 'vet_rdv_refuse', methods: ['POST'])]
    public function refuseRdv(
        int $id,
        Request $request,
        EntityManagerInterface $em,
        AppointmentNotificationService $appointmentNotificationService,
    ): Response
    {
        $rdv = $em->getRepository(Rendezvous::class)->find($id);

        if (!$rdv) {
            $this->addFlash('danger', 'appointments.vet_queue.flash.not_found');

            return $this->redirectToRoute('vet_rdv_list');
        }

        $this->denyAccessUnlessVetOwnsRdv($rdv);

        if ($rdv->getStatus() !== 'pending') {
            $this->addFlash('danger', 'appointments.vet_queue.flash.decline_pending_only');

            return $this->redirectToRoute('vet_rdv_list');
        }

        $rdv->setStatus('cancelled');

        $this->updateRdvDisponibiliteAvailability($em, $rdv, true);

        $client = $rdv->getClient();
        $vet = $rdv->getVet();
        if ($client && $vet) {
            $appointmentNotificationService->notifyClientDeclined($client, $vet, $rdv, $request->getLocale());
        }

        $em->flush();

        $this->addFlash('success', 'appointments.vet_queue.flash.declined');

        return $this->redirectToRoute('vet_rdv_list');
    }

    private function getVetUser(): User
    {
        $user = $this->getUser();

        if (!$user instanceof User || !in_array('ROLE_VETERINAIRE', $user->getRoles(), true)) {
            throw $this->createAccessDeniedException('Acces reserve au compte veterinaire.');
        }

        return $user;
    }

    private function denyAccessUnlessVetOwnsRdv(Rendezvous $rdv): void
    {
        if ($rdv->getVet()?->getId() !== $this->getVetUser()->getId()) {
            throw $this->createAccessDeniedException('Ce rendez-vous n appartient pas a ce compte veterinaire.');
        }
    }

    private function denyAccessUnlessVetOwnsDispo(Disponibilite $dispo): void
    {
        if ($dispo->getVet()?->getId() !== $this->getVetUser()->getId()) {
            throw $this->createAccessDeniedException('Cette disponibilite n appartient pas a ce compte veterinaire.');
        }
    }

    /**
     * @return array{
     *     pending: int,
     *     confirmed: int,
     *     cancelled: int,
     *     reviews: array<string, mixed>
     * }
     */
    private function buildVetStats(
        EntityManagerInterface $em,
        ReviewRepository $reviewRepository,
        User $vet
    ): array {
        return [
            'pending' => $this->countVetRendezvous($em, $vet, 'pending'),
            'confirmed' => $this->countVetRendezvous($em, $vet, 'confirmed'),
            'cancelled' => $this->countVetRendezvous($em, $vet, 'cancelled'),
            'reviews' => $reviewRepository->getStatsParVet((int) $vet->getId()),
        ];
    }

    private function countVetRendezvous(EntityManagerInterface $em, User $vet, ?string $status = null, string $search = ''): int
    {
        $where = ['r.vet_id = :vetId'];
        $params = ['vetId' => (int) $vet->getId()];

        if ($status !== null && $status !== '') {
            $where[] = 'r.status = :status';
            $params['status'] = $status;
        }

        if ($search !== '') {
            $where[] = '(
                (SELECT u.first_name FROM user u WHERE u.id = r.client_id) LIKE :search
                OR (SELECT u.last_name FROM user u WHERE u.id = r.client_id) LIKE :search
                OR (SELECT a.name FROM animal a WHERE a.idAnimal = r.animal_id) LIKE :search
            )';
            $params['search'] = '%' . $search . '%';
        }

        return (int) $em->getConnection()->fetchOne(
            'SELECT COUNT(*) FROM rendezvous r WHERE ' . implode(' AND ', $where),
            $params,
        );
    }

    private function updateRdvDisponibiliteAvailability(EntityManagerInterface $em, Rendezvous $rdv, bool $isAvailable): void
    {
        $dispoId = $em->createQueryBuilder()
            ->select('IDENTITY(r.disponibilite)')
            ->from(Rendezvous::class, 'r')
            ->where('r = :rdv')
            ->setParameter('rdv', $rdv)
            ->getQuery()
            ->getSingleScalarResult();

        if ($dispoId === null || $dispoId === '') {
            return;
        }

        $em->createQueryBuilder()
            ->update(Disponibilite::class, 'd')
            ->set('d.isAvailable', ':isAvailable')
            ->where('d.id = :id')
            ->setParameter('isAvailable', $isAvailable)
            ->setParameter('id', (int) $dispoId)
            ->getQuery()
            ->execute();
    }

}
