<?php

declare(strict_types=1);

namespace App\Service\Shopges;

use App\Service\BrevoTransactionalMailer;
use App\Entity\Shopges\Produit;

final class ShopMailService
{
    public function __construct(
        private readonly BrevoTransactionalMailer $mailer,
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

        $html = sprintf(
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
        );

        $text = sprintf(
            "Hello %s,\n\n%s is now available in the %s category.\nPrice: %s TND\nStock: %d\nDescription: %s\n\nOpen the shop now: %s",
            trim($customerName) !== '' ? $customerName : $toEmail,
            (string) $product->getTitle(),
            $product->getCategoryLabel(),
            $price,
            $stock,
            $description !== '' ? $description : 'No description provided yet.',
            $shopUrl,
        );

        $this->mailer->sendHtml(
            $toEmail,
            sprintf('New in the shop: %s', (string) $product->getTitle()),
            $html,
            $customerName,
            $text,
        );
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
