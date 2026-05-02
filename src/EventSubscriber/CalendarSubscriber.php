<?php
namespace App\EventSubscriber;

use App\Entity\Rendezvous;
use App\Entity\User;
use App\Entity\VetPlanningEvent;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Bundle\SecurityBundle\Security;

class CalendarSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private Security $security
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar): void
    {
        $user = $this->security->getUser();
        if (!$user instanceof User || !in_array('ROLE_VETERINAIRE', $user->getRoles(), true)) {
            return;
        }

        $start = $calendar->getStart();
        $end = $calendar->getEnd();

        $planningEvents = $this->entityManager->createQueryBuilder()
            ->select('e')
            ->from(VetPlanningEvent::class, 'e')
            ->where('e.vet = :vet')
            ->andWhere('e.startsAt <= :end')
            ->andWhere('e.endsAt IS NULL OR e.endsAt >= :start')
            ->setParameter('vet', $user)
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery()
            ->getResult();

        foreach ($planningEvents as $planningEvent) {
            $calendarEvent = new Event(
                $planningEvent->getTitle(),
                $planningEvent->getStartsAt(),
                $planningEvent->getEndsAt(),
                null,
                [
                    'backgroundColor' => $this->getColorForType($planningEvent->getEventType()),
                    'borderColor' => $this->getColorForType($planningEvent->getEventType()),
                    'extendedProps' => [
                        'type' => $planningEvent->getEventType(),
                        'description' => $planningEvent->getDescription(),
                    ],
                ]
            );

            $calendar->addEvent($calendarEvent);
        }

        $confirmedRdv = $this->entityManager->createQueryBuilder()
            ->select('r, c')
            ->from(Rendezvous::class, 'r')
            ->join('r.client', 'c')
            ->where('r.vet = :vet')
            ->andWhere('r.status = :status')
            ->andWhere('r.appointmentDate >= :startDate')
            ->andWhere('r.appointmentDate <= :endDate')
            ->setParameter('vet', $user)
            ->setParameter('status', 'confirmed')
            ->setParameter('startDate', (new \DateTimeImmutable($start->format('Y-m-d'))))
            ->setParameter('endDate', (new \DateTimeImmutable($end->format('Y-m-d'))))
            ->getQuery()
            ->getResult();

        foreach ($confirmedRdv as $rdv) {
            $appointmentDate = $rdv->getAppointmentDate();
            $appointmentTime = $rdv->getAppointmentTime();
            if (!$appointmentDate instanceof \DateTime || !$appointmentTime instanceof \DateTime) {
                continue;
            }

            $rdvStart = \DateTimeImmutable::createFromMutable(
                (clone $appointmentDate)->setTime(
                    (int) $appointmentTime->format('H'),
                    (int) $appointmentTime->format('i')
                )
            );
            $rdvEnd = $rdvStart->modify('+1 hour');

            $calendar->addEvent(new Event(
                'RDV: ' . $rdv->getClient()?->getFirstName() . ' ' . $rdv->getClient()?->getLastName(),
                $rdvStart,
                $rdvEnd,
                null,
                [
                    'backgroundColor' => '#2f6b5f',
                    'borderColor' => '#2f6b5f',
                    'extendedProps' => [
                        'type' => 'RENDEZVOUS',
                        'description' => $rdv->getDescription(),
                    ],
                ]
            ));
        }
    }

    private function getColorForType(string $type): string
    {
        return match ($type) {
            'SEMINAIRE' => '#8f6bb3',
            'CONGE' => '#c94c4c',
            'PROGRAMME' => '#d38745',
            default => '#5b7c99',
        };
    }
}
