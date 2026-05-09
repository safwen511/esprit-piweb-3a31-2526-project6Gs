<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RequestPasswordResetFormType;
use App\Form\ResetPasswordFormType;
use App\Form\SmsResetPasswordFormType;
use App\Repository\UserRepository;
use App\Service\PasswordResetMailer;
use App\Service\PasswordResetNotifier;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormError;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\ResetPassword\Controller\ResetPasswordControllerTrait;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;

#[Route('/reset-password')]
class ResetPasswordController extends AbstractController
{
    use ResetPasswordControllerTrait;

    private const SMS_RESET_USER_ID = 'password_reset.sms.user_id';
    private const RESET_CHANNEL = 'password_reset.channel';
    private const EMAIL_CHALLENGE_SESSION_KEY = 'password_reset.email.challenge';
    private const EMAIL_CODE_LENGTH = 6;
    private const EMAIL_CODE_TTL = 900;
    private const EMAIL_CODE_MAX_ATTEMPTS = 5;

    public function __construct(
        private readonly TranslatorInterface $translator,
    ) {
    }

    #[Route('', name: 'app_forgot_password_request')]
    public function request(
        Request $request,
        UserRepository $userRepository,
        ResetPasswordHelperInterface $resetPasswordHelper,
        PasswordResetNotifier $notifier,
        PasswordResetMailer $passwordResetMailer,
        LoggerInterface $logger,
    ): Response {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_dashboard');
        }

        $form = $this->createForm(RequestPasswordResetFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $identifier = trim((string) $form->get('identifier')->getData());
            $channel = strtolower(trim((string) $form->get('channel')->getData()));

            if (!$this->isValidRecoveryIdentifier($identifier)) {
                $form->get('identifier')->addError(new FormError('password_reset.request.identifier_invalid'));

                return $this->render('reset_password/request.html.twig', [
                    'requestForm' => $form,
                ]);
            }

            $user = $userRepository->findOneByRecoveryIdentifier($identifier);

            if ($user instanceof User) {
                if ($channel === 'email') {
                    try {
                        $this->startEmailCodeReset($request, $user, $passwordResetMailer, $request->getLocale());
                    } catch (\Throwable $exception) {
                        $logger->error('Password reset email could not be sent.', [
                            'user_id' => $user->getId(),
                            'email' => $user->getEmail(),
                            'exception' => $exception,
                        ]);
                        $this->addFlash('warning', $this->translator->trans(
                            $exception->getMessage() !== '' ? $exception->getMessage() : 'password_reset.flash.email_send_failed'
                        ));

                        return $this->render('reset_password/request.html.twig', [
                            'requestForm' => $form,
                        ]);
                    }

                    return $this->redirectToRoute('app_reset_password_code_verify');
                }

                try {
                    $notifier->startSmsVerification($user);
                } catch (\RuntimeException $exception) {
                    $this->addFlash('warning', $exception->getMessage());

                    return $this->render('reset_password/request.html.twig', [
                        'requestForm' => $form,
                    ]);
                }

                $request->getSession()->set(self::SMS_RESET_USER_ID, $user->getId());
                $request->getSession()->set(self::RESET_CHANNEL, 'sms');

                return $this->redirectToRoute('app_reset_password_code_verify');
            } else {
                $this->setTokenObjectInSession($resetPasswordHelper->generateFakeResetToken());
            }

            return $this->redirectToRoute('app_check_email', ['channel' => $channel]);
        }

        return $this->render('reset_password/request.html.twig', [
            'requestForm' => $form,
        ]);
    }

    #[Route('/check-email', name: 'app_check_email')]
    public function checkEmail(Request $request, ResetPasswordHelperInterface $resetPasswordHelper): Response
    {
        $token = $this->getTokenObjectFromSession();
        if ($token === null) {
            $token = $resetPasswordHelper->generateFakeResetToken();
        }

        $channel = $request->query->getString('channel', 'email');

        return $this->render('reset_password/check_email.html.twig', [
            'resetToken' => $token,
            'channel' => $channel,
            'expiresInMinutes' => (int) ceil($resetPasswordHelper->getTokenLifetime() / 60),
        ]);
    }

    #[Route('/verify', name: 'app_reset_password_code_verify')]
    #[Route('/sms/verify', name: 'app_reset_password_sms_verify')]
    public function verifyCode(
        Request $request,
        UserRepository $userRepository,
        PasswordResetNotifier $notifier,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
    ): Response {
        $userId = $request->getSession()->get(self::SMS_RESET_USER_ID);
        if (!is_int($userId) && !ctype_digit((string) $userId)) {
            $this->addFlash('warning', 'password_reset.flash.sms_session_missing');

            return $this->redirectToRoute('app_forgot_password_request');
        }

        $user = $userRepository->find((int) $userId);
        if (!$user instanceof User) {
            $request->getSession()->remove(self::SMS_RESET_USER_ID);
            $this->addFlash('warning', 'password_reset.flash.sms_session_missing');

            return $this->redirectToRoute('app_forgot_password_request');
        }

        $channel = $request->getSession()->get(self::RESET_CHANNEL, 'sms') === 'email' ? 'email' : 'sms';
        $form = $this->createForm(SmsResetPasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $isApproved = $channel === 'email'
                    ? $this->verifyEmailCode($request, $user, (string) $form->get('code')->getData())
                    : $notifier->verifySmsCode($user, (string) $form->get('code')->getData());
            } catch (\RuntimeException $exception) {
                $this->addFlash('warning', $exception->getMessage());

                return $this->render('reset_password/sms_verify.html.twig', [
                    'smsResetForm' => $form,
                    'channel' => $channel,
                    'destination' => $this->getVerificationDestination($channel, $user),
                ]);
            }

            if (!$isApproved) {
                $form->get('code')->addError(new FormError('password_reset.sms.code_invalid'));

                return $this->render('reset_password/sms_verify.html.twig', [
                    'smsResetForm' => $form,
                    'channel' => $channel,
                    'destination' => $this->getVerificationDestination($channel, $user),
                ]);
            }

            $hashedPassword = $passwordHasher->hashPassword($user, (string) $form->get('plainPassword')->getData());
            $user->setPassword($hashedPassword);
            $entityManager->flush();

            $request->getSession()->remove(self::SMS_RESET_USER_ID);
            $request->getSession()->remove(self::RESET_CHANNEL);
            $request->getSession()->remove(self::EMAIL_CHALLENGE_SESSION_KEY);
            $this->addFlash('success', 'password_reset.flash.password_updated');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('reset_password/sms_verify.html.twig', [
            'smsResetForm' => $form,
            'channel' => $channel,
            'destination' => $this->getVerificationDestination($channel, $user),
        ]);
    }

    #[Route('/reset', name: 'app_reset_password')]
    #[Route('/reset/{token}', name: 'app_reset_password_token')]
    public function reset(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        ResetPasswordHelperInterface $resetPasswordHelper,
        ?string $token = null,
    ): Response {
        if ($token !== null) {
            $this->storeTokenInSession($token);

            return $this->redirectToRoute('app_reset_password');
        }

        $token = $this->getTokenFromSession();
        if ($token === null) {
            throw $this->createNotFoundException('No reset password token found in the URL or session.');
        }

        try {
            /** @var User $user */
            $user = $resetPasswordHelper->validateTokenAndFetchUser($token);
        } catch (ResetPasswordExceptionInterface $exception) {
            $this->addFlash('danger', sprintf(
                '%s %s',
                $this->translator->trans('password_reset.flash.invalid_token'),
                $this->translator->trans($exception->getReason(), [], 'ResetPasswordBundle'),
            ));

            return $this->redirectToRoute('app_forgot_password_request');
        }

        $form = $this->createForm(ResetPasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resetPasswordHelper->removeResetRequest($token);

            $hashedPassword = $passwordHasher->hashPassword($user, (string) $form->get('plainPassword')->getData());
            $user->setPassword($hashedPassword);
            $entityManager->flush();

            $this->cleanSessionAfterReset();
            $this->addFlash('success', 'password_reset.flash.password_updated');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('reset_password/reset.html.twig', [
            'resetForm' => $form,
        ]);
    }
    private function isValidRecoveryIdentifier(string $identifier): bool
    {
        if ($identifier === '') {
            return false;
        }

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        $normalizedPhone = preg_replace('/\D+/', '', $identifier);

        return $normalizedPhone !== null && strlen($normalizedPhone) >= 7;
    }

    private function maskPhoneNumber(?string $phoneNumber): string
    {
        if ($phoneNumber === null || trim($phoneNumber) === '') {
            return '***';
        }

        $trimmed = trim($phoneNumber);
        $length = mb_strlen($trimmed);

        if ($length <= 4) {
            return $trimmed;
        }

        return str_repeat('*', max(0, $length - 4)).mb_substr($trimmed, -4);
    }

    private function startEmailReset(
        User $user,
        ResetPasswordHelperInterface $resetPasswordHelper,
        PasswordResetMailer $passwordResetMailer,
        string $locale,
    ): void {
        $resetToken = $resetPasswordHelper->generateResetToken($user);

        try {
            $passwordResetMailer->sendResetLink($user, $resetToken, $locale);
        } catch (\Throwable $exception) {
            try {
                $resetPasswordHelper->removeResetRequest($resetToken->getToken());
            } catch (ResetPasswordExceptionInterface) {
            }

            throw $exception;
        }

        $this->setTokenObjectInSession($resetToken);
    }

    private function startEmailCodeReset(
        Request $request,
        User $user,
        PasswordResetMailer $passwordResetMailer,
        string $locale,
    ): void {
        $code = $this->generateEmailCode();
        $passwordResetMailer->sendResetCode(
            $user,
            $code,
            (int) ceil(self::EMAIL_CODE_TTL / 60),
            $locale,
        );

        $request->getSession()->set(self::SMS_RESET_USER_ID, $user->getId());
        $request->getSession()->set(self::RESET_CHANNEL, 'email');
        $request->getSession()->set(self::EMAIL_CHALLENGE_SESSION_KEY, [
            'userId' => $user->getId(),
            'email' => $user->getEmail(),
            'codeHash' => password_hash($code, PASSWORD_DEFAULT),
            'expiresAt' => time() + self::EMAIL_CODE_TTL,
            'attempts' => 0,
        ]);
    }

    private function verifyEmailCode(Request $request, User $user, string $code): bool
    {
        $challenge = $request->getSession()->get(self::EMAIL_CHALLENGE_SESSION_KEY);
        $userId = $user->getId();

        if (
            !is_array($challenge)
            || !is_int($userId)
            || ($challenge['userId'] ?? null) !== $userId
            || ($challenge['email'] ?? null) !== $user->getEmail()
        ) {
            throw new \RuntimeException('password_reset.flash.email_session_missing');
        }

        $expiresAt = (int) ($challenge['expiresAt'] ?? 0);
        $attempts = (int) ($challenge['attempts'] ?? 0);
        $codeHash = (string) ($challenge['codeHash'] ?? '');

        if ($codeHash === '' || $expiresAt < time() || $attempts >= self::EMAIL_CODE_MAX_ATTEMPTS) {
            $request->getSession()->remove(self::EMAIL_CHALLENGE_SESSION_KEY);

            throw new \RuntimeException('password_reset.flash.email_session_missing');
        }

        if (!password_verify(trim($code), $codeHash)) {
            $challenge['attempts'] = $attempts + 1;
            $request->getSession()->set(self::EMAIL_CHALLENGE_SESSION_KEY, $challenge);

            return false;
        }

        return true;
    }

    private function generateEmailCode(): string
    {
        return str_pad((string) random_int(0, (10 ** self::EMAIL_CODE_LENGTH) - 1), self::EMAIL_CODE_LENGTH, '0', STR_PAD_LEFT);
    }

    private function getVerificationDestination(string $channel, User $user): string
    {
        if ($channel === 'email') {
            return $this->maskEmail($user->getEmail());
        }

        return $this->maskPhoneNumber($user->getPhoneNumber());
    }

    private function maskEmail(string $email): string
    {
        $email = trim($email);
        if ($email === '' || !str_contains($email, '@')) {
            return '***';
        }

        [$local, $domain] = explode('@', $email, 2);
        $visible = mb_substr($local, 0, 2);

        return $visible.str_repeat('*', max(3, mb_strlen($local) - 2)).'@'.$domain;
    }
}
