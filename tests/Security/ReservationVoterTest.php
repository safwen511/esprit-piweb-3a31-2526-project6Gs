<?php

declare(strict_types=1);

namespace App\Tests\Security;

use App\Entity\Reservation;
use App\Entity\User;
use App\Security\ReservationVoter;
use App\Tests\Support\EntityIdTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

final class ReservationVoterTest extends TestCase
{
    use EntityIdTrait;

    public function testAdminCanViewAnyReservationQrCode(): void
    {
        $admin = $this->user(1, ['ROLE_ADMIN']);
        $reservation = (new Reservation())->setClient($this->user(2))->setStatus('pending');

        $decision = (new ReservationVoter())->vote($this->token($admin), $reservation, [ReservationVoter::QR]);

        self::assertSame(VoterInterface::ACCESS_GRANTED, $decision);
    }

    public function testClientCanViewOwnReservationButQrRequiresApprovedStatus(): void
    {
        $client = $this->user(3);
        $reservation = (new Reservation())->setClient($client)->setStatus('pending');

        $voter = new ReservationVoter();

        self::assertSame(VoterInterface::ACCESS_GRANTED, $voter->vote($this->token($client), $reservation, [ReservationVoter::VIEW]));
        self::assertSame(VoterInterface::ACCESS_DENIED, $voter->vote($this->token($client), $reservation, [ReservationVoter::QR]));

        $reservation->setStatus('approved');
        self::assertSame(VoterInterface::ACCESS_GRANTED, $voter->vote($this->token($client), $reservation, [ReservationVoter::QR]));
    }

    public function testOtherUsersAreDenied(): void
    {
        $reservation = (new Reservation())->setClient($this->user(4))->setStatus('approved');

        $decision = (new ReservationVoter())->vote($this->token($this->user(5)), $reservation, [ReservationVoter::VIEW]);

        self::assertSame(VoterInterface::ACCESS_DENIED, $decision);
    }

    /**
     * @param list<string> $roles
     */
    private function user(int $id, array $roles = ['ROLE_USER']): User
    {
        $user = (new User())
            ->setEmail(sprintf('security%d@example.com', $id))
            ->setFirstName('Security')
            ->setLastName((string) $id)
            ->setRoles($roles);
        self::setEntityId($user, $id);

        return $user;
    }

    private function token(User $user): TokenInterface
    {
        $token = $this->createMock(TokenInterface::class);
        $token->method('getUser')->willReturn($user);

        return $token;
    }
}
