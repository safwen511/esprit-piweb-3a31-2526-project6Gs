<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\SocialMediaResolver;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class SocialMediaResolverTest extends TestCase
{
    public function testRelativeFeedMediaPathBecomesPublicPath(): void
    {
        $resolver = new SocialMediaResolver(
            $this->createMock(UrlGeneratorInterface::class),
            $this->createKernelMock(),
            'test-secret',
        );

        self::assertSame('/uploads/feed/photo.jpg', $resolver->resolveMediaUrl('uploads\\feed\\photo.jpg'));
    }

    public function testExternalFeedMediaUrlIsKeptAsIs(): void
    {
        $resolver = new SocialMediaResolver(
            $this->createMock(UrlGeneratorInterface::class),
            $this->createKernelMock(),
            'test-secret',
        );

        self::assertSame('https://example.com/photo.jpg', $resolver->resolveMediaUrl('https://example.com/photo.jpg'));
        self::assertNull($resolver->resolveMediaUrl('   '));
    }

    private function createKernelMock(): KernelInterface
    {
        $kernel = $this->createMock(KernelInterface::class);
        $kernel->method('getProjectDir')->willReturn(dirname(__DIR__, 2));

        return $kernel;
    }
}
