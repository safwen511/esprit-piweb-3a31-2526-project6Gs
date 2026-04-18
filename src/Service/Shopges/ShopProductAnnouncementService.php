<?php

declare(strict_types=1);

namespace App\Service\Shopges;

use App\Entity\Shopges\Produit;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class ShopProductAnnouncementService
{
    public function __construct(
        private readonly UserRepository $users,
        private readonly ShopMailService $mailService,
        private readonly UrlGeneratorInterface $urls,
        private readonly LoggerInterface $logger,
    ) {
    }

    /**
     * @return array{sent:int,failed:int}
     */
    public function announceNewProduct(Produit $product): array
    {
        $recipients = $this->users->findActiveEmailRecipients();
        if ($recipients === []) {
            return ['sent' => 0, 'failed' => 0];
        }

        $shopUrl = $this->urls->generate('app_shop', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $sent = 0;
        $failed = 0;

        foreach ($recipients as $user) {
            $email = trim((string) $user->getEmail());
            if ($email === '') {
                continue;
            }

            try {
                $this->mailService->sendNewShopProductAnnouncement(
                    $email,
                    $user->getFullName() !== '' ? $user->getFullName() : $email,
                    $product,
                    $shopUrl,
                );
                ++$sent;
            } catch (\Throwable $exception) {
                ++$failed;
                $this->logger->warning('Unable to send new product announcement email.', [
                    'email' => $email,
                    'message' => $exception->getMessage(),
                ]);
            }
        }

        return ['sent' => $sent, 'failed' => $failed];
    }
}


