<?php

namespace App\Security;

use App\Entity\User;
use App\Service\VetSignatureService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

final class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    use TargetPathTrait;

    private const FIREWALL_NAME = 'main';

    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly VetSignatureService $vetSignatureService,
    ) {
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): ?Response
    {
        $session = $request->hasSession() ? $request->getSession() : null;

        if ($session !== null) {
            $this->vetSignatureService->clearVerificationState($session);
        }

        $user = $token->getUser();
        if ($user instanceof User && $this->vetSignatureService->requiresSignatureChallenge($user)) {
            if ($session !== null) {
                $targetPath = $this->getTargetPath($session, self::FIREWALL_NAME);
                if (is_string($targetPath) && str_starts_with($targetPath, '/')) {
                    $this->vetSignatureService->rememberTargetPath($session, $targetPath);
                }
            }

            return new RedirectResponse($this->urlGenerator->generate('vet_signature'));
        }

        if ($session !== null) {
            $targetPath = $this->getTargetPath($session, self::FIREWALL_NAME);
            if (is_string($targetPath) && $targetPath !== '') {
                return new RedirectResponse($targetPath);
            }
        }

        if ($user instanceof User && in_array('ROLE_VETERINAIRE', $user->getRoles(), true)) {
            return new RedirectResponse($this->urlGenerator->generate('vet_dashboard'));
        }

        if ($user instanceof User && !in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            return new RedirectResponse($this->urlGenerator->generate('client_vet_list'));
        }

        return new RedirectResponse($this->urlGenerator->generate('app_home'));
    }
}
