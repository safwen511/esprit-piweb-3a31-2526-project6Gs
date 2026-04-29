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

        $pendingQuery = $em->createQueryBuilder()
            ->select('r, c, a')
            ->from(Rendezvous::class, 'r')
            ->join('r.client', 'c')
            ->join('r.animal', 'a')
            ->where('r.vet = :vet')
            ->andWhere('r.status = :status')
            ->setParameter('vet', $vet)
            ->setParameter('status', 'pending')
            ->orderBy('r.appointmentDate', 'ASC')
            ->addOrderBy('r.appointmentTime', 'ASC');

        $pendingRequests = $paginator->paginate(
            $pendingQuery,
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
        $planningEvent = $em->getRepository(VetPlanningEvent::class)->find($id);

        if (!$planningEvent) {
            $this->addFlash('danger', 'Evenement introuvable.');

            return $this->redirectToRoute('vet_calendar');
        }

        if ($planningEvent->getVet()->getId() !== $this->getVetUser()->getId()) {
            throw $this->createAccessDeniedException('Cet evenement n appartient pas a ce compte veterinaire.');
        }

        $em->remove($planningEvent);
        $em->flush();
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

        $query = $em->createQueryBuilder()
            ->select('d')
            ->from(Disponibilite::class, 'd')
            ->where('d.vet = :vet')
            ->setParameter('vet', $vet)
            ->orderBy('d.date', 'DESC')
            ->addOrderBy('d.startTime', 'DESC');

        $dispos = $paginator->paginate(
            $query,
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
        $dispo = $em->getRepository(Disponibilite::class)->find($id);

        if (!$dispo) {
            $this->addFlash('danger', 'Disponibilite introuvable.');

            return $this->redirectToRoute('vet_dispos');
        }

        $this->denyAccessUnlessVetOwnsDispo($dispo);

        $rdvs = $em->getRepository(Rendezvous::class)->findBy(['disponibilite' => $dispo]);
        if (count($rdvs) > 0) {
            $this->addFlash('danger', 'Impossible de supprimer ce creneau car des rendez-vous y sont lies.');

            return $this->redirectToRoute('vet_dispos');
        }

        $em->remove($dispo);
        $em->flush();

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

        $query = $em->createQueryBuilder()
            ->select('r, c, a')
            ->from(Rendezvous::class, 'r')
            ->join('r.client', 'c')
            ->join('r.animal', 'a')
            ->where('r.vet = :vet')
            ->setParameter('vet', $vet)
            ->orderBy('r.appointmentDate', 'DESC')
            ->addOrderBy('r.appointmentTime', 'DESC');

        if ($status !== '') {
            $query->andWhere('r.status = :status')
                ->setParameter('status', $status);
        }

        if ($search !== '') {
            $query->andWhere('c.firstName LIKE :search OR c.lastName LIKE :search OR a.name LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }

        $rdvs = $paginator->paginate(
            $query,
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

        $dispo = $rdv->getDisponibilite();
        if ($dispo) {
            $dispo->setIsAvailable(false);
        }

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

        $dispo = $rdv->getDisponibilite();
        if ($dispo) {
            $dispo->setIsAvailable(true);
        }

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
     *     disponibilites: int,
     *     planning_events: int,
     *     upcoming_confirmed: int,
     *     reviews: array<string, mixed>
     * }
     */
    private function buildVetStats(
        EntityManagerInterface $em,
        ReviewRepository $reviewRepository,
        User $vet
    ): array {
        $now = new \DateTimeImmutable();
        $qb = $em->createQueryBuilder();
        $upcomingCondition = $qb->expr()->orX(
            $qb->expr()->gt('r.appointmentDate', ':today'),
            $qb->expr()->andX(
                $qb->expr()->eq('r.appointmentDate', ':today'),
                $qb->expr()->gte('r.appointmentTime', ':nowTime')
            )
        );

        $upcomingConfirmed = (int) $qb
            ->select('COUNT(r.id)')
            ->from(Rendezvous::class, 'r')
            ->where('r.vet = :vet')
            ->andWhere('r.status = :status')
            ->andWhere($upcomingCondition)
            ->setParameter('vet', $vet)
            ->setParameter('status', 'confirmed')
            ->setParameter('today', $now->setTime(0, 0))
            ->setParameter('nowTime', $now)
            ->getQuery()
            ->getSingleScalarResult();

        return [
            'pending' => $em->getRepository(Rendezvous::class)->count([
                'vet' => $vet,
                'status' => 'pending',
            ]),
            'confirmed' => $em->getRepository(Rendezvous::class)->count([
                'vet' => $vet,
                'status' => 'confirmed',
            ]),
            'cancelled' => $em->getRepository(Rendezvous::class)->count([
                'vet' => $vet,
                'status' => 'cancelled',
            ]),
            'disponibilites' => $em->getRepository(Disponibilite::class)->count([
                'vet' => $vet,
            ]),
            'planning_events' => $em->getRepository(VetPlanningEvent::class)->count([
                'vet' => $vet,
            ]),
            'upcoming_confirmed' => $upcomingConfirmed,
            'reviews' => $reviewRepository->getStatsParVet((int) $vet->getId()),
        ];
    }
}
