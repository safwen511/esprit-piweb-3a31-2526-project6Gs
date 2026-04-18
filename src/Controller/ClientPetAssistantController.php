<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\PetCareAssistantService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/client')]
final class ClientPetAssistantController extends AbstractController
{
    #[Route('/pet-assistant/ask', name: 'client_pet_assistant_ask', methods: ['POST'])]
    public function ask(
        Request $request,
        PetCareAssistantService $petCareAssistantService,
        TranslatorInterface $translator,
    ): JsonResponse {
        $user = $this->getUser();
        if (!$user instanceof User || $user->isVeteranApproved()) {
            return $this->json([
                'success' => false,
                'message' => $translator->trans('pet_ai.messages.unavailable_for_this_account', [], null, $request->getLocale()),
            ], Response::HTTP_FORBIDDEN);
        }

        if (!$this->isCsrfTokenValid('pet_care_assistant', (string) $request->headers->get('X-CSRF-TOKEN'))) {
            return $this->json([
                'success' => false,
                'message' => $translator->trans('pet_ai.messages.security_error', [], null, $request->getLocale()),
            ], Response::HTTP_FORBIDDEN);
        }

        try {
            $payload = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return $this->json([
                'success' => false,
                'message' => $translator->trans('pet_ai.messages.bad_payload', [], null, $request->getLocale()),
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!is_array($payload)) {
            return $this->json([
                'success' => false,
                'message' => $translator->trans('pet_ai.messages.bad_payload', [], null, $request->getLocale()),
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $result = $petCareAssistantService->answerQuestion(
                (string) ($payload['question'] ?? ''),
                $request->getLocale(),
            );
        } catch (\InvalidArgumentException $exception) {
            return $this->json([
                'success' => false,
                'message' => $translator->trans($exception->getMessage(), [], null, $request->getLocale()),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Throwable) {
            return $this->json([
                'success' => false,
                'message' => $translator->trans('pet_ai.messages.temporarily_unavailable', [], null, $request->getLocale()),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json([
            'success' => true,
            'in_scope' => $result['in_scope'],
            'answer' => $result['answer'],
        ]);
    }
}
