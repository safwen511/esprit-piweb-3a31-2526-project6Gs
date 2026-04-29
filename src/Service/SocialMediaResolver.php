<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class SocialMediaResolver
{
    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly KernelInterface $kernel,
        #[Autowire('%kernel.secret%')]
        private readonly string $appSecret,
    ) {
    }

    public function resolveAvatarUrl(?User $user): ?string
    {
        return $this->resolveMediaUrl($user?->getProfileImageUrl());
    }

    public function resolveMediaUrl(?string $path): ?string
    {
        $path = trim((string) $path);
        if ($path === '') {
            return null;
        }

        if (
            str_starts_with($path, 'http://')
            || str_starts_with($path, 'https://')
            || str_starts_with($path, 'data:')
        ) {
            return $path;
        }

        if (preg_match('/^[A-Za-z]:\\\\/', $path) === 1) {
            return $this->createSignedLocalUrl($path);
        }

        if (str_starts_with($path, '/')) {
            return $path;
        }

        return '/'.ltrim(str_replace('\\', '/', $path), '/');
    }

    public function resolveSignedLocalPath(string $token, string $signature): ?string
    {
        $decodedPath = $this->decodeToken($token);
        if ($decodedPath === null) {
            return null;
        }

        $realPath = realpath($decodedPath);
        if ($realPath === false || !is_file($realPath)) {
            return null;
        }

        if (!hash_equals($this->createSignature($realPath), $signature)) {
            return null;
        }

        return $this->isAllowedLocalPath($realPath) ? $realPath : null;
    }

    private function createSignedLocalUrl(string $path): ?string
    {
        $realPath = realpath($path);
        if ($realPath === false || !is_file($realPath) || !$this->isAllowedLocalPath($realPath)) {
            return null;
        }

        return $this->urlGenerator->generate('social_asset_show', [
            'token' => $this->encodeToken($realPath),
            'signature' => $this->createSignature($realPath),
        ]);
    }

    private function isAllowedLocalPath(string $path): bool
    {
        $normalizedPath = $this->normalizePath($path);
        if ($normalizedPath === null) {
            return false;
        }

        foreach ($this->allowedRoots() as $root) {
            $normalizedRoot = $this->normalizePath($root);
            if ($normalizedRoot === null) {
                continue;
            }

            if ($normalizedPath === $normalizedRoot || str_starts_with($normalizedPath, $normalizedRoot.'\\')) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return list<string>
     */
    private function allowedRoots(): array
    {
        $roots = [
            $this->kernel->getProjectDir().DIRECTORY_SEPARATOR.'public',
        ];

        $userProfile = getenv('USERPROFILE');
        if (is_string($userProfile) && trim($userProfile) !== '') {
            $roots[] = $userProfile;
        }

        return array_values(array_unique($roots));
    }

    private function createSignature(string $path): string
    {
        return hash_hmac('sha256', $path, $this->appSecret);
    }

    private function encodeToken(string $path): string
    {
        return rtrim(strtr(base64_encode($path), '+/', '-_'), '=');
    }

    private function decodeToken(string $token): ?string
    {
        $paddingLength = (4 - strlen($token) % 4) % 4;
        $decoded = base64_decode(strtr($token . str_repeat('=', $paddingLength), '-_', '+/'), true);

        return is_string($decoded) && $decoded !== '' ? $decoded : null;
    }

    private function normalizePath(string $path): ?string
    {
        $path = trim($path);
        if ($path === '') {
            return null;
        }

        return strtolower(rtrim(str_replace('/', '\\', $path), '\\'));
    }
}
