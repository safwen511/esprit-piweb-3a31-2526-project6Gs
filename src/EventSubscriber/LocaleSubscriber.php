<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class LocaleSubscriber implements EventSubscriberInterface
{
    private const ALLOWED_LOCALES = ['en', 'fr'];

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 20],
        ];
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

        $requestedLocale = (string) $request->query->get('_locale', '');
        if (in_array($requestedLocale, self::ALLOWED_LOCALES, true)) {
            $request->getSession()->set('_locale', $requestedLocale);
            $request->setLocale($requestedLocale);

            return;
        }

        if (!$request->hasPreviousSession()) {
            $request->setLocale($request->getDefaultLocale());

            return;
        }

        $storedLocale = (string) $request->getSession()->get('_locale', $request->getDefaultLocale());
        $request->setLocale(in_array($storedLocale, self::ALLOWED_LOCALES, true) ? $storedLocale : $request->getDefaultLocale());
    }
}
