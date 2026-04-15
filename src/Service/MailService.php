<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService
{
    public function __construct(private MailerInterface $mailer) {}

    // Email au client quand le vet confirme
    public function sendConfirmationRdv(
        string $toEmail,
        string $clientName,
        string $date,
        string $time,
        string $vetName
    ): void {
        $email = (new Email())
            ->from('ilefbenchouchane3@gmail.com')
            ->to($toEmail)
            ->subject('✅ Votre rendez-vous est confirmé !')
            ->html("
                <h2>Bonjour $clientName,</h2>
                <p>Votre rendez-vous avec le Dr. <strong>$vetName</strong>
                est confirmé pour le <strong>$date</strong> à <strong>$time</strong>.</p>
                <p>Merci de votre confiance !</p>
            ");
        $this->mailer->send($email);
    }

    // Email au vétérinaire quand un client prend un rdv
    public function sendRdvNotificationToVet(
        string $toEmail,
        string $vetName,
        string $clientName,
        string $date,
        string $time
    ): void {
        $email = (new Email())
            ->from('ilefbenchouchane3@gmail.com')
            ->to($toEmail)
            ->subject('🐾 Nouveau rendez-vous à traiter')
            ->html("
                <h2>Bonjour Dr. $vetName,</h2>
                <p>Un nouveau rendez-vous a été demandé par <strong>$clientName</strong>
                pour le <strong>$date</strong> à <strong>$time</strong>.</p>
                <p>Connectez-vous pour confirmer ou refuser ce rendez-vous.</p>
            ");
        $this->mailer->send($email);
    }
}