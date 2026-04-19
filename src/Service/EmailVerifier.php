<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\Model\VerifyEmailSignatureComponents;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class EmailVerifier
{
    public function __construct(
        private VerifyEmailHelperInterface $verifyEmailHelper,
        private MailerInterface $mailer,
        private EntityManagerInterface $entityManager,
        private string $fromEmail,
    ) {
    }

    public function sendEmailConfirmation(string $verifyRouteName, User $user): void
    {
        $signatureComponents = $this->createSignature($verifyRouteName, $user);

        $email = (new TemplatedEmail())
            ->from(new Address($this->fromEmail, 'FurHope Animal Shelter'))
            ->to((string) $user->getEmail())
            ->subject('Verify your FurHope account')
            ->htmlTemplate('registration/verification_email.html.twig')
            ->context([
                'signedUrl' => $signatureComponents->getSignedUrl(),
                'expiresAtMessageKey' => $signatureComponents->getExpirationMessageKey(),
                'expiresAtMessageData' => $signatureComponents->getExpirationMessageData(),
                'user' => $user,
            ]);

        $this->mailer->send($email);
    }

    public function generateSignedUrl(string $verifyRouteName, User $user): string
    {
        return $this->createSignature($verifyRouteName, $user)->getSignedUrl();
    }

    /**
     * @throws VerifyEmailExceptionInterface
     */
    public function handleEmailConfirmation(Request $request, User $user): void
    {
        $this->verifyEmailHelper->validateEmailConfirmationFromRequest(
            $request,
            (string) $user->getId(),
            (string) $user->getEmail()
        );

        $user->setIsVerified(true);
        $this->entityManager->flush();
    }

    private function createSignature(string $verifyRouteName, User $user): VerifyEmailSignatureComponents
    {
        return $this->verifyEmailHelper->generateSignature(
            $verifyRouteName,
            (string) $user->getId(),
            (string) $user->getEmail(),
            ['id' => $user->getId()]
        );
    }
}
