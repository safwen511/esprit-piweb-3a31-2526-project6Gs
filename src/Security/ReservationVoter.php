<?php

declare(strict_types=1);

namespace App\Security;

use App\Entity\Reservation;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * @extends Voter<string, Reservation>
 */
final class ReservationVoter extends Voter
{
    public const VIEW = 'RESERVATION_VIEW';
    public const QR = 'RESERVATION_QR';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof Reservation
            && in_array($attribute, [self::VIEW, self::QR], true);
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        if ($user->hasRole('ROLE_ADMIN')) {
            return true;
        }

        if ($subject->getClient()?->getId() !== $user->getId()) {
            return false;
        }

        return match ($attribute) {
            self::VIEW => true,
            self::QR => strtoupper($subject->getStatus()) === 'APPROVED',
            default => false,
        };
    }
}
