<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PasswordResetNotifier
{
    private const SMS_CHALLENGE_SESSION_KEY = 'password_reset.sms.challenge';
    private const DIRECT_SMS_CODE_LENGTH = 6;
    private const DIRECT_SMS_CODE_TTL = 900;
    private const DIRECT_SMS_MAX_ATTEMPTS = 5;

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly RequestStack $requestStack,
        private readonly string $projectDir,
        private readonly string $appEnv,
        private readonly string $twilioSid = '',
        private readonly string $twilioAuthToken = '',
        private readonly string $twilioFromNumber = '',
        private readonly string $twilioVerifyServiceSid = '',
        private readonly string $defaultSmsCountryCode = '216',
    ) {
    }

    public function startSmsVerification(User $user): void
    {
        $phoneNumber = $this->getSmsDestination($user);
        if ($phoneNumber === null || trim($phoneNumber) === '') {
            throw new \RuntimeException('password_reset.flash.sms_missing_phone');
        }

        if ($this->hasTwilioVerifyConfiguration()) {
            $this->clearLocalSmsChallenge();
            $this->postTwilioRequest(
                sprintf(
                    'https://verify.twilio.com/v2/Services/%s/Verifications',
                    $this->twilioVerifyServiceSid,
                ),
                [
                    'To' => $phoneNumber,
                    'Channel' => 'sms',
                ],
                'password_reset.flash.sms_send_failed',
            );

            return;
        }

        if ($this->hasDirectSmsConfiguration()) {
            $this->startDirectSmsVerification($user, $phoneNumber);

            return;
        }

        throw new \RuntimeException('password_reset.flash.sms_not_configured');
    }

    public function verifySmsCode(User $user, string $code): bool
    {
        $phoneNumber = $this->getSmsDestination($user);
        if ($phoneNumber === null || trim($phoneNumber) === '') {
            throw new \RuntimeException('password_reset.flash.sms_missing_phone');
        }

        if ($this->hasTwilioVerifyConfiguration()) {
            $response = $this->postTwilioRequest(
                sprintf(
                    'https://verify.twilio.com/v2/Services/%s/VerificationCheck',
                    $this->twilioVerifyServiceSid,
                ),
                [
                    'To' => $phoneNumber,
                    'Code' => trim($code),
                ],
                'password_reset.flash.sms_verification_failed',
            );

            return ($response['status'] ?? null) === 'approved';
        }

        if ($this->hasDirectSmsConfiguration()) {
            return $this->verifyDirectSmsCode($user, $phoneNumber, trim($code));
        }

        throw new \RuntimeException('password_reset.flash.sms_not_configured');
    }

    public function isSmsVerificationConfigured(): bool
    {
        return $this->hasDirectSmsConfiguration() || $this->hasTwilioVerifyConfiguration();
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

    private function startDirectSmsVerification(User $user, string $phoneNumber): void
    {
        $code = $this->generateDirectSmsCode();
        $message = sprintf(
            'FurHope password reset code: %s. It expires in %d minutes.',
            $code,
            (int) ceil(self::DIRECT_SMS_CODE_TTL / 60),
        );

        $response = $this->postTwilioRequest(
            sprintf(
                'https://api.twilio.com/2010-04-01/Accounts/%s/Messages.json',
                rawurlencode($this->twilioSid),
            ),
            [
                'To' => $phoneNumber,
                'From' => $this->twilioFromNumber,
                'Body' => $message,
            ],
            'password_reset.flash.sms_send_failed',
        );

        $this->clearLocalSmsChallenge();
        $this->getSession()->set(self::SMS_CHALLENGE_SESSION_KEY, [
            'userId' => $user->getId(),
            'phoneNumber' => $phoneNumber,
            'codeHash' => password_hash($code, PASSWORD_DEFAULT),
            'expiresAt' => time() + self::DIRECT_SMS_CODE_TTL,
            'attempts' => 0,
            'messageSid' => is_string($response['sid'] ?? null) ? $response['sid'] : null,
        ]);
    }

    private function verifyDirectSmsCode(User $user, string $phoneNumber, string $code): bool
    {
        $challenge = $this->getSession()->get(self::SMS_CHALLENGE_SESSION_KEY);
        $userId = $user->getId();

        if (
            !is_array($challenge)
            || !is_int($userId)
            || ($challenge['userId'] ?? null) !== $userId
            || ($challenge['phoneNumber'] ?? null) !== $phoneNumber
        ) {
            throw new \RuntimeException('password_reset.flash.sms_session_missing');
        }

        $expiresAt = (int) ($challenge['expiresAt'] ?? 0);
        $attempts = (int) ($challenge['attempts'] ?? 0);
        $codeHash = (string) ($challenge['codeHash'] ?? '');

        if ($codeHash === '' || $expiresAt < time() || $attempts >= self::DIRECT_SMS_MAX_ATTEMPTS) {
            $this->clearLocalSmsChallenge();

            throw new \RuntimeException('password_reset.flash.sms_session_missing');
        }

        if (!password_verify($code, $codeHash)) {
            $challenge['attempts'] = $attempts + 1;
            $this->getSession()->set(self::SMS_CHALLENGE_SESSION_KEY, $challenge);

            return false;
        }

        $this->clearLocalSmsChallenge();

        return true;
    }

    /**
     * @return array<string, mixed>
     */
    private function postTwilioRequest(string $url, array $body, string $fallbackMessage): array
    {
        try {
            $response = $this->httpClient->request('POST', $url, [
                'auth_basic' => [$this->twilioSid, $this->twilioAuthToken],
                'body' => $body,
            ]);

            $statusCode = $response->getStatusCode();
            $payload = $response->toArray(false);

            if ($statusCode >= 400) {
                throw new \RuntimeException($this->extractTwilioErrorMessage($payload, $fallbackMessage));
            }

            return is_array($payload) ? $payload : [];
        } catch (ExceptionInterface $exception) {
            throw new \RuntimeException($fallbackMessage, 0, $exception);
        }
    }

    private function hasTwilioVerifyConfiguration(): bool
    {
        return $this->twilioSid !== ''
            && $this->twilioAuthToken !== ''
            && $this->twilioVerifyServiceSid !== '';
    }

    private function hasDirectSmsConfiguration(): bool
    {
        return $this->twilioSid !== ''
            && $this->twilioAuthToken !== ''
            && $this->twilioFromNumber !== '';
    }

    private function generateDirectSmsCode(): string
    {
        return str_pad((string) random_int(0, (10 ** self::DIRECT_SMS_CODE_LENGTH) - 1), self::DIRECT_SMS_CODE_LENGTH, '0', STR_PAD_LEFT);
    }

    private function extractTwilioErrorMessage(mixed $payload, string $fallbackMessage): string
    {
        if (is_array($payload)) {
            $message = $payload['message'] ?? $payload['detail'] ?? null;
            if (is_string($message) && trim($message) !== '') {
                return trim($message);
            }
        }

        return $fallbackMessage;
    }

    private function getSession(): SessionInterface
    {
        $mainRequest = $this->requestStack->getMainRequest();
        if ($mainRequest === null || !$mainRequest->hasSession()) {
            throw new \RuntimeException('password_reset.flash.sms_session_missing');
        }

        return $mainRequest->getSession();
    }

    private function clearLocalSmsChallenge(): void
    {
        $mainRequest = $this->requestStack->getMainRequest();
        if ($mainRequest === null || !$mainRequest->hasSession()) {
            return;
        }

        $mainRequest->getSession()->remove(self::SMS_CHALLENGE_SESSION_KEY);
    }
}
