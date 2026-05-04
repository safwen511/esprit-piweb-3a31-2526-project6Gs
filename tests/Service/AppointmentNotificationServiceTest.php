<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Animal;
use App\Entity\Notification;
use App\Entity\Rendezvous;
use App\Entity\User;
use App\Service\AppointmentNotificationService;
use App\Tests\Support\EntityIdTrait;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Notifier\TexterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class AppointmentNotificationServiceTest extends TestCase
{
    use EntityIdTrait;

    public function testVetRequestCreatesInAppNotificationAndSkipsSmsWhenNotConfigured(): void
    {
        $vet = $this->user(10, 'vet@example.com', '+216 22 333 444');
        $client = $this->user(20, 'client@example.com');
        $animal = (new Animal())->setName('Milo')->setType('cat');
        $appointment = (new Rendezvous())
            ->setAppointmentDate(new \DateTimeImmutable('2026-05-10'))
            ->setAppointmentTime(new \DateTimeImmutable('2026-05-10 14:30'));

        $persisted = null;
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects(self::once())
            ->method('persist')
            ->with(self::callback(static function (Notification $notification) use (&$persisted): bool {
                $persisted = $notification;

                return true;
            }));

        $texter = $this->createMock(TexterInterface::class);
        $texter->expects(self::never())->method('send');

        $service = new AppointmentNotificationService(
            $entityManager,
            $this->translator(),
            $texter,
            twilioDsn: 'null://null',
        );

        $result = $service->notifyVetRequest($vet, $client, $animal, $appointment, 'en');

        self::assertSame(['in_app' => true, 'sms' => false], $result);
        self::assertInstanceOf(Notification::class, $persisted);
        self::assertSame(10, $persisted->getRecipientId());
        self::assertSame(20, $persisted->getActorId());
        self::assertSame(AppointmentNotificationService::TYPE_REQUEST, $persisted->getType());
        self::assertFalse($persisted->isRead());
    }

    public function testSameRecipientAndActorDoesNotCreateNotification(): void
    {
        $user = $this->user(30, 'same@example.com');
        $appointment = (new Rendezvous())
            ->setAppointmentDate(new \DateTimeImmutable('2026-05-10'))
            ->setAppointmentTime(new \DateTimeImmutable('2026-05-10 14:30'));

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects(self::never())->method('persist');

        $service = new AppointmentNotificationService(
            $entityManager,
            $this->translator(),
            $this->createMock(TexterInterface::class),
        );

        $service->createClientConfirmedNotification($user, $user, $appointment, 'en');
    }

    private function user(int $id, string $email, ?string $phone = null): User
    {
        $user = (new User())
            ->setEmail($email)
            ->setFirstName('Test')
            ->setLastName((string) $id);
        $user->setPhoneNumber($phone);
        self::setEntityId($user, $id);

        return $user;
    }

    private function translator(): TranslatorInterface
    {
        $translator = $this->createMock(TranslatorInterface::class);
        $translator->method('trans')->willReturnCallback(
            static fn (string $id, array $parameters = []): string => trim($id.' '.implode(' ', array_map('strval', $parameters)))
        );

        return $translator;
    }
}
