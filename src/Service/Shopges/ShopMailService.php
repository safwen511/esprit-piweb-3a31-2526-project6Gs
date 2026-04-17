<?php

declare(strict_types=1);

namespace App\Service\Shopges;

use App\Entity\Shopges\Produit;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class ShopMailService
{
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly string $fromEmail,
    ) {
    }

    public function sendNewShopProductAnnouncement(
        string $toEmail,
        string $customerName,
        Produit $product,
        string $shopUrl,
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
}
