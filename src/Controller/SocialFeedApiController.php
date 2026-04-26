<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\SocialAiService;
use App\Service\SocialFeedTriviaService;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class SocialFeedApiController extends AbstractSocialController
{
    #[Route('/social/api/animal-fact', name: 'social_api_animal_fact', methods: ['GET'])]
    public function animalFact(
        Security $security,
        SocialFeedTriviaService $triviaService,
    ): JsonResponse
    {
        $this->requireCurrentSocialUser($security);

        $fact = $triviaService->fetchAnimalFact();

        return new JsonResponse([
            'fact' => $fact['fact'],
            'source' => $fact['source'],
            'image' => $fact['image'],
        ], Response::HTTP_OK);
    }

    #[Route('/social/api/joke', name: 'social_api_joke', methods: ['GET'])]
    public function joke(
        Security $security,
        SocialFeedTriviaService $triviaService,
    ): JsonResponse
    {
        $this->requireCurrentSocialUser($security);

        $joke = $triviaService->fetchJoke();

        return new JsonResponse([
            'joke' => $joke['joke'],
            'source' => $joke['source'],
        ], Response::HTTP_OK);
    }

    #[Route('/social/api/ai-status', name: 'social_api_ai_status', methods: ['GET'])]
    public function aiStatus(
        Request $request,
        Security $security,
        SocialAiService $socialAiService,
    ): JsonResponse {
        $this->requireCurrentSocialUser($security);

        $boot = filter_var((string) $request->query->get('boot', '0'), FILTER_VALIDATE_BOOL);

        return new JsonResponse($socialAiService->warmUp($boot), Response::HTTP_OK);
    }

    #[Route('/social/api/caption-suggestion', name: 'social_api_caption_suggestion', methods: ['POST'])]
    public function captionSuggestion(
        Request $request,
        Security $security,
        SocialAiService $socialAiService,
    ): JsonResponse {
        $this->requireCurrentSocialUser($security);

        if (!$this->isCsrfTokenValid('social_ai_caption_suggestion', (string) $request->request->get('_token'))) {
            return new JsonResponse([
                'error' => 'Invalid AI caption request.',
            ], Response::HTTP_BAD_REQUEST);
        }

        $file = $request->files->get('mediaFile');
        if (!$file instanceof UploadedFile) {
            return new JsonResponse([
                'error' => 'Please choose an image first.',
            ], Response::HTTP_BAD_REQUEST);
        }

        $mimeType = (string) ($file->getMimeType() ?: $file->getClientMimeType());
        if (!str_starts_with($mimeType, 'image/')) {
            return new JsonResponse([
                'error' => 'AI caption suggestions only work with images.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $moderation = $socialAiService->moderateImagePath((string) $file->getRealPath());
            if ($moderation['blocked']) {
                return new JsonResponse([
                    'error' => str_contains(strtolower($moderation['reason']), 'unsafe')
                        ? 'This image looks unsafe and cannot be posted.'
                        : 'This image does not look like a clear animal photo.',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $suggestion = $socialAiService->suggestCaptionFromUpload($file);

            return new JsonResponse([
                'suggestion' => $suggestion['caption'],
                'detectedLabel' => $suggestion['detected_label'],
            ], Response::HTTP_OK);
        } catch (\RuntimeException $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
                'retryable' => true,
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}
