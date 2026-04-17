<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\SocialMediaResolver;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/social/assets', name: 'social_asset_')]
final class SocialMediaController extends AbstractController
{
    #[Route(
        '/local/{token}/{signature}',
        name: 'show',
        requirements: ['token' => '[A-Za-z0-9\-_]+', 'signature' => '[A-Fa-f0-9]{64}'],
        methods: ['GET']
    )]
    public function show(
        string $token,
        string $signature,
        SocialMediaResolver $socialMediaResolver,
    ): BinaryFileResponse {
        $path = $socialMediaResolver->resolveSignedLocalPath($token, $signature);

        if ($path === null) {
            throw $this->createNotFoundException('Asset not found.');
        }

        $response = new BinaryFileResponse($path);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, basename($path));
        $response->setAutoEtag();
        $response->setAutoLastModified();
        $response->headers->set('Cache-Control', 'private, max-age=3600');

        return $response;
    }
}
