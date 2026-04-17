<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Service\VetSignatureService;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

final class VetSignatureSubscriber implements EventSubscriberInterface
{
    private const EXCLUDED_ROUTES = [
        'app_login',
        'app_logout',
        'vet_signature',
        'vet_signature_verify',
    ];

    public function __construct(
        private readonly Security $security,
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly VetSignatureService $vetSignatureService,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 10],
            LoginSuccessEvent::class => 'onLoginSuccess',
        ];
    }

    public function onLoginSuccess(LoginSuccessEvent $event): void
    {
        $request = $event->getRequest();
        if (!$request->hasSession()) {
            return;
        }

        $this->vetSignatureService->clearVerificationState($request->getSession());
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();
        if (!$request->hasSession()) {
            return;
        }

        $route = (string) $request->attributes->get('_route', '');
        if ($route === '' || in_array($route, self::EXCLUDED_ROUTES, true)) {
            return;
        }

        $user = $this->security->getUser();
        if (!$user instanceof User || !$this->vetSignatureService->requiresSignatureChallenge($user)) {
            return;
        }

        $session = $request->getSession();
        if ($this->vetSignatureService->isVerified($session)) {
            return;
        }

        if ($route !== 'app_home' && !str_starts_with($route, 'vet_')) {
            return;
        }

        if ($request->isMethodCacheable() && str_starts_with($request->getPathInfo(), '/vet')) {
            $this->vetSignatureService->rememberTargetPath($session, $request->getRequestUri());
        }

        $event->setResponse(new RedirectResponse($this->urlGenerator->generate('vet_signature')));
    }
}
