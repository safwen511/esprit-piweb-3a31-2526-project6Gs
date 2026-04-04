<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class UserSessionListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $session = $request->getSession();

        // Check for userId in query parameter first
        if ($request->query->has('user')) {
            $userId = $request->query->get('user');
            $session->set('current_user_id', (int)$userId);
        }
        // Check for userId in route parameter
        elseif ($request->attributes->has('userId')) {
            $userId = $request->attributes->get('userId');
            $session->set('current_user_id', (int)$userId);
        }
        // Check for userId in route parameters with different names
        elseif ($request->attributes->has('id')) {
            $route = $request->attributes->get('_route');
            // For routes like /animals/{userId}, the parameter might be captured as 'id'
            if (strpos($route, 'animal_my_animals') !== false || strpos($route, 'animal_new') !== false) {
                $userId = $request->attributes->get('id');
                $session->set('current_user_id', (int)$userId);
            }
        }

        // Set a request attribute for easy access in controllers
        if ($session->has('current_user_id')) {
            $request->attributes->set('sessionUserId', $session->get('current_user_id'));
        }
    }
}
