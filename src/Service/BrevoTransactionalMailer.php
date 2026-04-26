<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class BrevoTransactionalMailer
{
    private const API_URL = 'https://api.brevo.com/v3/smtp/email';

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly MailerInterface $mailer,
        #[Autowire('%app.mailer_from%')]
        private readonly string $fromEmail,
        #[Autowire('%env(string:BREVO_API_KEY)%')]
        private readonly string $brevoApiKey = '',
    ) {
    }

    public function sendHtml(
        string $toEmail,
        string $subject,
        string $htmlContent,
        ?string $toName = null,
        ?string $textContent = null,
    ): void {
        $normalizedRecipient = trim($toEmail);
        if ($normalizedRecipient === '') {
            throw new TransportException('Brevo recipient email is missing.');
        }

        if (trim($this->brevoApiKey) === '') {
            $this->sendWithSymfonyMailer($normalizedRecipient, $subject, $htmlContent, $toName, $textContent);

            return;
        }

        $sender = Address::create($this->fromEmail);
        $payload = [
            'sender' => [
                'name' => $sender->getName() !== '' ? $sender->getName() : $sender->getAddress(),
                'email' => $sender->getAddress(),
            ],
            'to' => [[
                'email' => $normalizedRecipient,
                'name' => trim((string) $toName) !== '' ? trim((string) $toName) : $normalizedRecipient,
            ]],
            'subject' => $subject,
            'htmlContent' => $htmlContent,
        ];

        $plainText = trim((string) $textContent);
        if ($plainText !== '') {
            $payload['textContent'] = $plainText;
        }

        $response = $this->httpClient->request('POST', self::API_URL, [
            'headers' => [
                'accept' => 'application/json',
                'api-key' => trim($this->brevoApiKey),
                'content-type' => 'application/json',
            ],
            'json' => $payload,
            'timeout' => 30,
        ]);

        $this->assertSuccessfulBrevoResponse($response);
    }

    private function sendWithSymfonyMailer(
        string $toEmail,
        string $subject,
        string $htmlContent,
        ?string $toName,
        ?string $textContent,
    ): void {
        $email = (new Email())
            ->from($this->fromEmail)
            ->to(new Address($toEmail, trim((string) $toName) !== '' ? trim((string) $toName) : $toEmail))
            ->subject($subject)
            ->html($htmlContent);

        $plainText = trim((string) $textContent);
        if ($plainText !== '') {
            $email->text($plainText);
        }

        $this->mailer->send($email);
    }

    private function assertSuccessfulBrevoResponse(ResponseInterface $response): void
    {
        $statusCode = $response->getStatusCode();
        if ($statusCode >= 200 && $statusCode < 300) {
            return;
        }

        $content = $response->getContent(false);
        $payload = json_decode($content, true);
        $message = is_array($payload)
            ? (string) ($payload['message'] ?? $payload['code'] ?? $payload['error'] ?? '')
            : '';

        throw new TransportException(
            $message !== ''
                ? sprintf('Brevo API request failed: %s', $message)
                : sprintf('Brevo API request failed with HTTP %d.', $statusCode),
            $statusCode
        );
    }
}
