<?php

declare(strict_types=1);

namespace App\Twig;

use App\Entity\User;
use App\Service\SocialMediaResolver;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class SocialExtension extends AbstractExtension
{
    public function __construct(private readonly SocialMediaResolver $socialMediaResolver)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('social_media_url', [$this, 'socialMediaUrl']),
            new TwigFunction('social_avatar_url', [$this, 'socialAvatarUrl']),
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
}
