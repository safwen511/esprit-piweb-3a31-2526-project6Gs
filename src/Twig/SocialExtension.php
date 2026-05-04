<?php

declare(strict_types=1);

namespace App\Twig;

use App\Entity\User;
use App\Repository\Shopges\PanierRepository;
use App\Service\SocialMediaResolver;
use Symfony\Bundle\SecurityBundle\Security;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class SocialExtension extends AbstractExtension
{
    public function __construct(
        private readonly SocialMediaResolver $socialMediaResolver,
        private readonly Security $security,
        private readonly PanierRepository $panierRepository,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('social_media_url', [$this, 'socialMediaUrl']),
            new TwigFunction('social_avatar_url', [$this, 'socialAvatarUrl']),
            new TwigFunction('cart_quantity', [$this, 'cartQuantity']),
        ];
    }

    public function socialMediaUrl(?string $path): ?string
    {
        return $this->socialMediaResolver->resolveMediaUrl($path);
    }

    public function socialAvatarUrl(?User $user): ?string
    {
        return $this->socialMediaResolver->resolveAvatarUrl($user);
    }

    public function cartQuantity(): int
    {
        $user = $this->security->getUser();
        if (!$user instanceof User) {
            return 0;
        }

        return $this->panierRepository->getCartQuantity($user);
    }
}
