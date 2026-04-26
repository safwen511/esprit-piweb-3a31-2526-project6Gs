<?php

declare(strict_types=1);

namespace App\Service\Shopges;

use App\Entity\Shopges\Produit;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

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
            if ($email === '' || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
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
            } catch (TransportExceptionInterface $exception) {
                $this->logger->error('Unable to deliver shop product announcement emails because the mail transport failed.', [
                    'email' => $email,
                    'message' => $exception->getMessage(),
                ]);

                throw new \RuntimeException($this->buildTransportFailureMessage($exception), 0, $exception);
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

    private function buildTransportFailureMessage(TransportExceptionInterface $exception): string
    {
        $message = strtolower($exception->getMessage());
        if (str_contains($message, 'authenticate') || str_contains($message, '535')) {
            return 'Product created, but announcement emails are unavailable because the configured mailer credentials were rejected. Update MAILER_DSN before retrying.';
        }

        return 'Product created, but announcement emails are currently unavailable because the configured mail transport could not be reached.';
    }
}

