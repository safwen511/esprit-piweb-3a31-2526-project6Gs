<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PasswordResetNotifier
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private string $projectDir,
        private string $appEnv,
        private string $twilioSid = '',
        private string $twilioAuthToken = '',
        private string $twilioFromNumber = '',
        private string $twilioVerifyServiceSid = '',
        private string $defaultSmsCountryCode = '216',
    ) {
    }

    public function startSmsVerification(User $user): void
    {
        $phoneNumber = $this->getSmsDestination($user);
        if ($phoneNumber === null || trim($phoneNumber) === '') {
            throw new \RuntimeException('password_reset.flash.sms_missing_phone');
        }

        if (!$this->isSmsVerificationConfigured()) {
            throw new \RuntimeException('password_reset.flash.sms_not_configured');
        }

        try {
            $this->httpClient->request('POST', sprintf(
                'https://verify.twilio.com/v2/Services/%s/Verifications',
                $this->twilioVerifyServiceSid,
            ), [
                'auth_basic' => [$this->twilioSid, $this->twilioAuthToken],
                'body' => [
                    'To' => $phoneNumber,
                    'Channel' => 'sms',
                ],
            ])->getContent();
        } catch (ExceptionInterface $exception) {
            throw new \RuntimeException('password_reset.flash.sms_send_failed', 0, $exception);
        }
    }

    public function verifySmsCode(User $user, string $code): bool
    {
        $phoneNumber = $this->getSmsDestination($user);
        if ($phoneNumber === null || trim($phoneNumber) === '') {
            throw new \RuntimeException('password_reset.flash.sms_missing_phone');
        }

        if (!$this->isSmsVerificationConfigured()) {
            throw new \RuntimeException('password_reset.flash.sms_not_configured');
        }

        try {
            $response = $this->httpClient->request('POST', sprintf(
                'https://verify.twilio.com/v2/Services/%s/VerificationCheck',
                $this->twilioVerifyServiceSid,
            ), [
                'auth_basic' => [$this->twilioSid, $this->twilioAuthToken],
                'body' => [
                    'To' => $phoneNumber,
                    'Code' => trim($code),
                ],
            ])->toArray(false);
        } catch (ExceptionInterface $exception) {
            throw new \RuntimeException('password_reset.flash.sms_verification_failed', 0, $exception);
        }

        return ($response['status'] ?? null) === 'approved';
    }

    public function isSmsVerificationConfigured(): bool
    {
        return $this->twilioSid !== ''
            && $this->twilioAuthToken !== ''
            && $this->twilioVerifyServiceSid !== '';
    }

    private function getSmsDestination(User $user): ?string
    {
        $phoneNumber = $user->getPhoneNumber();
        if ($phoneNumber === null) {
            return null;
        }

        $trimmed = trim($phoneNumber);
        if ($trimmed === '') {
            return null;
        }

        if (str_starts_with($trimmed, '+')) {
            return '+'.preg_replace('/\D+/', '', $trimmed);
        }

        $digits = preg_replace('/\D+/', '', $trimmed);
        if ($digits === null || $digits === '') {
            return null;
        }

        $countryCode = preg_replace('/\D+/', '', $this->defaultSmsCountryCode) ?: '216';

        return '+'.$countryCode.$digits;
    }
}
