<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordToken;
use Twig\Environment;

final class PasswordResetMailer
{
    public function __construct(
        private readonly BrevoTransactionalMailer $mailer,
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly TranslatorInterface $translator,
        private readonly Environment $twig,
    ) {
    }

    public function sendResetLink(User $user, ResetPasswordToken $resetToken, string $locale = 'fr'): void
    {
        $recipientEmail = trim((string) $user->getEmail());
        if ($recipientEmail === '' || filter_var($recipientEmail, FILTER_VALIDATE_EMAIL) === false) {
            throw new \RuntimeException('password_reset.flash.email_missing');
        }

        $resetUrl = $this->urlGenerator->generate('app_reset_password_token', [
            'token' => $resetToken->getToken(),
        ], UrlGeneratorInterface::ABSOLUTE_URL);

        $expiresInMinutes = max(
            1,
            (int) ceil(($resetToken->getExpiresAt()->getTimestamp() - time()) / 60)
        );
        $displayName = $user->getFullName() !== '' ? $user->getFullName() : $recipientEmail;
        $subject = $this->translator->trans('password_reset.email.subject', [], null, $locale);
        $html = $this->twig->render('reset_password/email.html.twig', [
            'user' => $user,
            'resetUrl' => $resetUrl,
            'expiresInMinutes' => $expiresInMinutes,
            'locale' => $locale,
        ]);
        $text = sprintf(
            "%s\n\n%s\n\n%s: %s\n\n%s\n\n%s",
            $this->translator->trans('password_reset.email.greeting', [
                '%user%' => $user->getFirstName() ?: $recipientEmail,
            ], null, $locale),
            $this->translator->trans('password_reset.email.intro', [], null, $locale),
            $this->translator->trans('password_reset.email.cta', [], null, $locale),
            $resetUrl,
            $this->translator->trans('password_reset.email.expires', [
                '%minutes%' => $expiresInMinutes,
            ], null, $locale),
            $this->translator->trans('password_reset.email.ignore', [], null, $locale),
        );

        $this->mailer->sendHtml($recipientEmail, $subject, $html, $displayName, $text);
    }
}
