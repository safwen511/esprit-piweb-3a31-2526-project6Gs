<?php
namespace App\Service;

use App\Entity\Shopges\Produit;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\Translation\TranslatorInterface;

class MailService
{
    public function __construct(
        private MailerInterface $mailer,
        private TranslatorInterface $translator,
        private string $fromEmail,
    ) {}

    // Email au client quand le vet confirme
    public function sendConfirmationRdv(
        string $toEmail,
        string $clientName,
        string $date,
        string $time,
        string $vetName,
        string $locale = 'fr',
    ): void {
        $email = (new Email())
            ->from($this->fromEmail)
            ->to($toEmail)
            ->subject($this->translator->trans('appointments.email.client_subject', [], null, $locale))
            ->html(sprintf(
                '<h2>%s</h2><p>%s</p><p>%s</p>',
                $this->escape($this->translator->trans('appointments.email.client_heading', [
                    '%client%' => $clientName,
                ], null, $locale)),
                $this->translator->trans('appointments.email.client_intro', [
                    '%vet%' => $this->escape($vetName),
                    '%date%' => $this->escape($date),
                    '%time%' => $this->escape($time),
                ], null, $locale),
                $this->escape($this->translator->trans('appointments.email.client_closing', [], null, $locale))
            ));
        $this->mailer->send($email);
    }

    // Email au vétérinaire quand un client prend un rdv
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

        $email = (new Email())
            ->from($this->fromEmail)
            ->to($toEmail)
            ->subject($this->translator->trans('appointments.email.vet_subject', [], null, $locale))
            ->html(sprintf(
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
            ));
        $this->mailer->send($email);
    }

    public function sendNewShopProductAnnouncement(
        string $toEmail,
        string $customerName,
        Produit $product,
        string $shopUrl,
        string $locale = 'en',
    ): void {
        $title = $this->escape((string) $product->getTitle());
        $category = $this->escape($product->getCategoryLabel());
        $description = trim((string) ($product->getDescription() ?? ''));
        $price = number_format($product->getVisiblePrice(), 2, '.', ' ');
        $stock = (int) ($product->getStock() ?? 0);

        $email = (new Email())
            ->from($this->fromEmail)
            ->to($toEmail)
            ->subject(sprintf('New in the shop: %s', (string) $product->getTitle()))
            ->html(sprintf(
                '<h2>Hello %s, a new shop product just arrived.</h2>
                <p><strong>%s</strong> is now available in the <strong>%s</strong> category.</p>
                <ul>
                    <li><strong>Price:</strong> %s TND</li>
                    <li><strong>Stock:</strong> %d</li>
                    <li><strong>Description:</strong> %s</li>
                </ul>
                <p>Open the shop to check the latest products and currently available offers.</p>
                <p><a href="%s">Open the shop now</a></p>',
                $this->escape($customerName),
                $title,
                $category,
                $this->escape($price),
                $stock,
                $this->escape($description !== '' ? $description : 'No description provided yet.'),
                $this->escape($shopUrl),
            ));

        $this->mailer->send($email);
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

