<?php

namespace App\Twig;

use App\Repository\AdoptionRequestRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class AppTwigGlobals extends AbstractExtension implements GlobalsInterface
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly AdoptionRequestRepository $adoptionRequestRepository,
    ) {
    }

    public function getGlobals(): array
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request?->getSession();
        $currentUserId = $session?->get('current_user_id');

        return [
            'ownerPendingCount' => $currentUserId ? $this->adoptionRequestRepository->countPendingForOwner((int) $currentUserId) : 0,
        ];
    }
}
