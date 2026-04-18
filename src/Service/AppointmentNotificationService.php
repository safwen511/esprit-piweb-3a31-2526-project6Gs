<?php

namespace App\Service;

use App\Entity\Animal;
use App\Entity\Notification;
use App\Entity\Rendezvous;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class AppointmentNotificationService
{
    public const TYPE_REQUEST = 'appt_request';
    public const TYPE_CONFIRMED = 'appt_confirmed';
    public const TYPE_DECLINED = 'appt_declined';

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly TranslatorInterface $translator,
        private readonly TexterInterface $texter,
        private readonly string $defaultSmsCountryCode = '216',
        private readonly string $twilioDsn = '',
    ) {
    }

    /**
     * @return array{in_app: bool, sms: bool}
     */
    public function notifyVetRequest(
        User $vet,
        User $client,
        Animal $animal,
        Rendezvous $appointment,
        string $locale,
    ): array {
        $this->createVetRequestNotification($vet, $client, $animal, $appointment, $locale);

        return [
            'in_app' => true,
            'sms' => $this->sendSmsToUser($vet, $this->translator->trans('appointments.sms.vet_request', [
                '%client%' => $client->getFullName(),
                '%animal%' => $animal->getName() ?: $this->translator->trans('labels.na', [], null, $locale),
                '%date%' => $appointment->getAppointmentDate()->format('d/m/Y'),
                '%time%' => $appointment->getAppointmentTime()->format('H:i'),
            ], null, $locale)),
        ];
    }

    /**
     * @return array{in_app: bool, sms: bool}
     */
    public function notifyClientConfirmed(
        User $client,
        User $vet,
        Rendezvous $appointment,
        string $locale,
    ): array {
        $this->createClientConfirmedNotification($client, $vet, $appointment, $locale);

        return [
            'in_app' => true,
            'sms' => $this->sendSmsToUser($client, $this->translator->trans('appointments.sms.client_confirmed', [
                '%vet%' => $vet->getFullName(),
                '%date%' => $appointment->getAppointmentDate()->format('d/m/Y'),
                '%time%' => $appointment->getAppointmentTime()->format('H:i'),
            ], null, $locale)),
        ];
    }

    /**
     * @return array{in_app: bool, sms: bool}
     */
    public function notifyClientDeclined(
        User $client,
        User $vet,
        Rendezvous $appointment,
        string $locale,
    ): array {
        $this->createClientDeclinedNotification($client, $vet, $appointment, $locale);

        return [
            'in_app' => true,
            'sms' => $this->sendSmsToUser($client, $this->translator->trans('appointments.sms.client_declined', [
                '%vet%' => $vet->getFullName(),
                '%date%' => $appointment->getAppointmentDate()->format('d/m/Y'),
                '%time%' => $appointment->getAppointmentTime()->format('H:i'),
            ], null, $locale)),
        ];
    }

    public function createVetRequestNotification(
        User $vet,
        User $client,
        Animal $animal,
        Rendezvous $appointment,
        string $locale,
    ): void {
        $this->create(
            (int) $vet->getId(),
            (int) $client->getId(),
            self::TYPE_REQUEST,
            $this->translator->trans('appointments.notifications.vet_request', [
                '%client%' => $client->getFullName(),
                '%animal%' => $animal->getName() ?: $this->translator->trans('labels.na', [], null, $locale),
                '%date%' => $appointment->getAppointmentDate()->format('d/m/Y'),
                '%time%' => $appointment->getAppointmentTime()->format('H:i'),
            ], null, $locale),
        );
    }

    public function createClientConfirmedNotification(
        User $client,
        User $vet,
        Rendezvous $appointment,
        string $locale,
    ): void {
        $this->create(
            (int) $client->getId(),
            (int) $vet->getId(),
            self::TYPE_CONFIRMED,
            $this->translator->trans('appointments.notifications.client_confirmed', [
                '%vet%' => $vet->getFullName(),
                '%date%' => $appointment->getAppointmentDate()->format('d/m/Y'),
                '%time%' => $appointment->getAppointmentTime()->format('H:i'),
            ], null, $locale),
        );
    }

    public function createClientDeclinedNotification(
        User $client,
        User $vet,
        Rendezvous $appointment,
        string $locale,
    ): void {
        $this->create(
            (int) $client->getId(),
            (int) $vet->getId(),
            self::TYPE_DECLINED,
            $this->translator->trans('appointments.notifications.client_declined', [
                '%vet%' => $vet->getFullName(),
                '%date%' => $appointment->getAppointmentDate()->format('d/m/Y'),
                '%time%' => $appointment->getAppointmentTime()->format('H:i'),
            ], null, $locale),
        );
    }

    private function create(int $recipientId, int $actorId, string $type, string $message): void
    {
        if ($recipientId <= 0 || $actorId <= 0 || $recipientId === $actorId) {
            return;
        }

        $notification = new Notification();
        $notification
            ->setRecipientId($recipientId)
            ->setActorId($actorId)
            ->setType($type)
            ->setMessage($this->limit($message, 255))
            ->setIsRead(false)
            ->setCreatedAt(new \DateTimeImmutable());

        $this->entityManager->persist($notification);
    }

    private function limit(string $value, int $length): string
    {
        $value = trim((string) preg_replace('/\s+/', ' ', $value));

        if (mb_strlen($value) <= $length) {
            return $value;
        }

        return rtrim(mb_substr($value, 0, max(0, $length - 3))).'...';
    }

    private function sendSmsToUser(User $user, string $message): bool
    {
        $phoneNumber = $this->resolveSmsDestination($user);
        if ($phoneNumber === null || !$this->isSmsConfigured()) {
            return false;
        }

        try {
            $this->texter->send(new SmsMessage($phoneNumber, $this->limit($message, 480)));

            return true;
        } catch (\Throwable) {
            return false;
        }
    }

    private function isSmsConfigured(): bool
    {
        $dsn = trim($this->twilioDsn);

        return $dsn !== '' && $dsn !== 'null://null';
    }

    private function resolveSmsDestination(User $user): ?string
    {
        $phoneNumber = $user->getPhoneNumber() ?: $user->getPhone();
        if ($phoneNumber === null) {
            return null;
        }

        $trimmed = trim($phoneNumber);
        if ($trimmed === '') {
            return null;
        }

        if (str_starts_with($trimmed, '+')) {
            $digits = preg_replace('/\D+/', '', $trimmed);

            return $digits ? '+'.$digits : null;
        }

        $digits = preg_replace('/\D+/', '', $trimmed);
        if ($digits === null || $digits === '') {
            return null;
        }

        $countryCode = preg_replace('/\D+/', '', $this->defaultSmsCountryCode) ?: '216';

        return '+'.$countryCode.$digits;
    }
}
