<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Animal;
use App\Entity\Rendezvous;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

final class RendezvousTest extends TestCase
{
    public function testRendezvousStoresAppointmentDetails(): void
    {
        $client = (new User())->setEmail('client@example.com');
        $vet = (new User())->setEmail('vet@example.com');
        $animal = (new Animal())->setName('Milo')->setType('Cat');
        $date = new \DateTimeImmutable('2026-05-15');
        $time = new \DateTimeImmutable('09:30');

        $rdv = (new Rendezvous())
            ->setClient($client)
            ->setVet($vet)
            ->setAnimal($animal)
            ->setAppointmentDate($date)
            ->setAppointmentTime($time)
            ->setStatus('confirmed')
            ->setDescription('Annual vaccine visit');

        self::assertSame($client, $rdv->getClient());
        self::assertSame($vet, $rdv->getVet());
        self::assertSame($animal, $rdv->getAnimal());
        self::assertSame($date, $rdv->getAppointmentDate());
        self::assertSame($time, $rdv->getAppointmentTime());
        self::assertSame('confirmed', $rdv->getStatus());
        self::assertSame('Annual vaccine visit', $rdv->getDescription());
    }
}
