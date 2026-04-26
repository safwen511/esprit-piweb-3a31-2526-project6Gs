<?php

namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;

class MailService
{
    public function __construct(
        private BrevoTransactionalMailer $mailer,
        private TranslatorInterface $translator,
    ) {
    }

    public function sendConfirmationRdv(
        string $toEmail,
        string $clientName,
        string $date,
        string $time,
        string $vetName,
        string $locale = 'fr',
    ): void {
        $subject = $this->translator->trans('appointments.email.client_subject', [], null, $locale);
        $html = sprintf(
            '<h2>%s</h2><p>%s</p><p>%s</p>',
            $this->escape($this->translator->trans('appointments.email.client_heading', [
                '%client%' => $clientName,
            ], null, $locale)),
            $this->translator->trans('appointments.email.client_intro', [
                '%vet%' => sprintf('<strong>%s</strong>', $this->escape($vetName)),
                '%date%' => sprintf('<strong>%s</strong>', $this->escape($date)),
                '%time%' => sprintf('<strong>%s</strong>', $this->escape($time)),
            ], null, $locale),
            $this->escape($this->translator->trans('appointments.email.client_closing', [], null, $locale))
        );
        $text = sprintf(
            "%s\n\n%s\n\n%s",
            $this->translator->trans('appointments.email.client_heading', [
                '%client%' => $clientName,
            ], null, $locale),
            strip_tags($this->translator->trans('appointments.email.client_intro', [
                '%vet%' => $vetName,
                '%date%' => $date,
                '%time%' => $time,
            ], null, $locale)),
            $this->translator->trans('appointments.email.client_closing', [], null, $locale),
        );

        $this->mailer->sendHtml($toEmail, $subject, $html, $clientName, $text);
    }

    public function sendRdvNotificationToVet(
        string $toEmail,
        string $vetName,
        string $clientName,
        string $date,
        string $time,
        ?string $animalName = null,
        ?string $animalType = null,
        ?string $clientPhone = null,
        ?string $description = null,
        string $locale = 'fr',
    ): void {
        $translatedAnimalType = $this->translateAnimalType($animalType, $locale);
        $animalLabel = trim(sprintf(
            '%s%s%s',
            $animalName !== null && $animalName !== '' ? $animalName : $this->translator->trans('labels.na', [], null, $locale),
            $translatedAnimalType !== null && $translatedAnimalType !== '' ? ' (' : '',
            $translatedAnimalType !== null && $translatedAnimalType !== '' ? $translatedAnimalType.')' : ''
        ));
        $reason = trim((string) $description);

        $subject = $this->translator->trans('appointments.email.vet_subject', [], null, $locale);
        $html = sprintf(
            '<h2>%s</h2><p>%s</p><ul><li><strong>%s:</strong> %s</li><li><strong>%s:</strong> %s</li><li><strong>%s:</strong> %s</li><li><strong>%s:</strong> %s</li></ul><p>%s</p>',
            $this->escape($this->translator->trans('appointments.email.vet_heading', [
                '%vet%' => $vetName,
            ], null, $locale)),
            $this->translator->trans('appointments.email.vet_intro', [
                '%client%' => sprintf('<strong>%s</strong>', $this->escape($clientName)),
                '%date%' => sprintf('<strong>%s</strong>', $this->escape($date)),
                '%time%' => sprintf('<strong>%s</strong>', $this->escape($time)),
            ], null, $locale),
            $this->escape($this->translator->trans('appointments.email.vet_client', [], null, $locale)),
            $this->escape($clientName),
            $this->escape($this->translator->trans('appointments.email.vet_animal', [], null, $locale)),
            $this->escape($animalLabel),
            $this->escape($this->translator->trans('appointments.email.vet_phone', [], null, $locale)),
            $this->escape($clientPhone ?: $this->translator->trans('labels.na', [], null, $locale)),
            $this->escape($this->translator->trans('appointments.email.vet_reason', [], null, $locale)),
            nl2br($this->escape($reason !== '' ? $reason : $this->translator->trans('appointments.email.vet_no_reason', [], null, $locale))),
            $this->escape($this->translator->trans('appointments.email.vet_action', [], null, $locale))
        );
        $text = sprintf(
            "%s\n\n%s\n- %s: %s\n- %s: %s\n- %s: %s\n- %s: %s\n\n%s",
            $this->translator->trans('appointments.email.vet_heading', [
                '%vet%' => $vetName,
            ], null, $locale),
            strip_tags($this->translator->trans('appointments.email.vet_intro', [
                '%client%' => $clientName,
                '%date%' => $date,
                '%time%' => $time,
            ], null, $locale)),
            $this->translator->trans('appointments.email.vet_client', [], null, $locale),
            $clientName,
            $this->translator->trans('appointments.email.vet_animal', [], null, $locale),
            $animalLabel,
            $this->translator->trans('appointments.email.vet_phone', [], null, $locale),
            $clientPhone ?: $this->translator->trans('labels.na', [], null, $locale),
            $this->translator->trans('appointments.email.vet_reason', [], null, $locale),
            $reason !== '' ? preg_replace('/\s+/', ' ', $reason) : $this->translator->trans('appointments.email.vet_no_reason', [], null, $locale),
            $this->translator->trans('appointments.email.vet_action', [], null, $locale)
        );

        $this->mailer->sendHtml($toEmail, $subject, $html, $vetName, $text);
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    private function translateAnimalType(?string $animalType, string $locale): ?string
    {
        $animalType = trim((string) $animalType);
        if ($animalType === '') {
            return null;
        }

        $key = 'appointments.animal_types.'.str_replace([' ', '-'], '_', mb_strtolower($animalType));
        $translated = $this->translator->trans($key, [], null, $locale);

        return $translated === $key ? $animalType : $translated;
    }
}
