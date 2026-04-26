<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class PetCareAssistantService
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly TranslatorInterface $translator,
        private readonly string $groqApiKey = '',
    ) {
    }

    /**
     * @return array{in_scope: bool, answer: string}
     */
    public function answerQuestion(string $question, string $locale): array
    {
        $question = $this->cleanText($question);
        $locale = $this->detectResponseLocale($question, $locale);

        if ($question === '') {
            throw new \InvalidArgumentException('pet_ai.validation.question_required');
        }

        if ($this->isGreeting($question)) {
            return $this->buildGreetingResponse($locale);
        }

        if (mb_strlen($question) < 3) {
            throw new \InvalidArgumentException('pet_ai.validation.question_required');
        }

        if ($this->groqApiKey === '') {
            return $this->buildFallbackResponse($question, $locale);
        }

        try {
            $response = $this->httpClient->request('POST', 'https://api.groq.com/openai/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer '.$this->groqApiKey,
                    'Content-Type' => 'application/json',
                ],
                'timeout' => 20,
                'json' => [
                    'model' => 'llama3-8b-8192',
                    'temperature' => 0.2,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'You are a concise pet-care assistant. Only answer questions about companion animal vaccinations, safe or unsafe foods, feeding basics, hydration, greetings, and routine preventive care. Reply in the language of the user question; if unclear, use the provided interface locale. Keep answers short: 1 to 3 short sentences. Do not diagnose diseases, prescribe medicine, or answer unrelated topics. If the question is out of scope, refuse briefly. If the user greets you, greet them back and briefly explain what pet topics you can help with. Return valid JSON only with keys in_scope and answer.',
                        ],
                        [
                            'role' => 'user',
                            'content' => $this->buildPrompt($question, $locale),
                        ],
                    ],
                ],
            ]);

            $payload = $response->toArray(false);
            $content = (string) ($payload['choices'][0]['message']['content'] ?? '');
            $decoded = $this->decodeAssistantResponse($content);
            if ($decoded !== null) {
                return $decoded;
            }
        } catch (ExceptionInterface|\Throwable) {
        }

        return $this->buildFallbackResponse($question, $locale);
    }

    private function buildPrompt(string $question, string $locale): string
    {
        return sprintf(
            <<<PROMPT
Interface locale: %s
Question: %s

Return valid JSON only with this exact shape:
{"in_scope":true,"answer":"..."}

Rules:
- answer only pet vaccination, feeding, toxic foods, hydration, or routine preventive care questions
- if the user is greeting you, greet them back and briefly explain how you can help
- if the question is unrelated, return {"in_scope":false,"answer":"..."}
- answer only what was asked
- keep it short and factual
- for urgent or dangerous situations, tell the user to contact a veterinarian promptly
- no markdown, no extra keys
PROMPT,
            $locale,
            $question,
        );
    }

    /**
     * @return array{in_scope: bool, answer: string}|null
     */
    private function decodeAssistantResponse(string $content): ?array
    {
        $content = trim($content);
        if ($content === '') {
            return null;
        }

        if (str_starts_with($content, '```')) {
            $content = preg_replace('/^```(?:json)?\s*|\s*```$/', '', $content) ?? $content;
        }

        $decoded = json_decode(trim($content), true);
        if (!is_array($decoded) || !array_key_exists('in_scope', $decoded) || !array_key_exists('answer', $decoded)) {
            return null;
        }

        $answer = $this->limitText($this->cleanText((string) $decoded['answer']), 420);
        if ($answer === '') {
            return null;
        }

        return [
            'in_scope' => (bool) $decoded['in_scope'],
            'answer' => $answer,
        ];
    }

    /**
     * @return array{in_scope: bool, answer: string}
     */
    private function buildUnavailableResponse(string $locale): array
    {
        return [
            'in_scope' => false,
            'answer' => $this->translator->trans('pet_ai.messages.temporarily_unavailable', [], null, $locale),
        ];
    }

    /**
     * @return array{in_scope: bool, answer: string}
     */
    private function buildGreetingResponse(string $locale): array
    {
        if ($locale === 'fr') {
            return [
                'in_scope' => true,
                'answer' => 'Bonjour. Comment puis-je vous aider pour votre animal aujourd hui ? Je peux aider pour les vaccins, l alimentation, l hydratation et la prevention de base.',
            ];
        }

        return [
            'in_scope' => true,
            'answer' => 'Hello. How can I help with your pet today? I can help with vaccines, food safety, hydration, and basic preventive care.',
        ];
    }

    /**
     * @return array{in_scope: bool, answer: string}
     */
    private function buildFallbackResponse(string $question, string $locale): array
    {
        $question = mb_strtolower($question);

        if ($this->isGreeting($question)) {
            return $this->buildGreetingResponse($locale);
        }

        if ($this->matches($question, ['vaccin', 'vaccine', 'vaccination', 'booster', 'rage', 'rabies'])) {
            if ($locale === 'fr') {
                return [
                    'in_scope' => true,
                    'answer' => 'Les chiots et chatons commencent souvent les vaccins de base vers 6 a 8 semaines, puis font des rappels toutes les 3 a 4 semaines jusqu a environ 16 semaines. La rage et les rappels adultes dependent du pays et du veterinaire.',
                ];
            }

            return [
                'in_scope' => true,
                'answer' => 'Puppies and kittens usually start core vaccines around 6 to 8 weeks, then get boosters every 3 to 4 weeks until about 16 weeks. Rabies timing and adult boosters depend on local rules and your veterinarian.',
            ];
        }

        if ($this->matches($question, ['chocolate', 'chocolat', 'xylitol', 'raisin', 'raisins', 'grape', 'grapes', 'onion', 'onions', 'oignon', 'oignons', 'garlic', 'ail', 'avocado', 'avocat', 'bone', 'bones', 'os cuit', 'os cuits'])) {
            if ($locale === 'fr') {
                return [
                    'in_scope' => true,
                    'answer' => 'Le chocolat, le xylitol, les raisins, les oignons, l ail, l avocat et les os cuits peuvent etre dangereux pour les chiens ou les chats. Si votre animal en a mange, contactez rapidement un veterinaire.',
                ];
            }

            return [
                'in_scope' => true,
                'answer' => 'Chocolate, xylitol, grapes, onions, garlic, avocado, and cooked bones can be dangerous for dogs or cats. If your pet ate any of these, contact a veterinarian promptly.',
            ];
        }

        if ($this->matches($question, ['eat', 'eating', 'food', 'feed', 'diet', 'meal', 'croquette', 'nourrir', 'manger', 'alimentation', 'nourriture'])) {
            if ($locale === 'fr') {
                return [
                    'in_scope' => true,
                    'answer' => 'Donnez surtout une alimentation complete adaptee a l espece et a l age, avec les changements de nourriture faits progressivement sur quelques jours. Evitez les restes de table gras, sales ou sucres.',
                ];
            }

            return [
                'in_scope' => true,
                'answer' => 'Use a complete diet that matches the pet species and life stage, and change food gradually over several days. Avoid fatty, salty, or sugary table scraps.',
            ];
        }

        if ($this->matches($question, ['water', 'drink', 'drinking', 'hydrate', 'hydration', 'dehydr', 'eau', 'boire', 'hydrat'])) {
            if ($locale === 'fr') {
                return [
                    'in_scope' => true,
                    'answer' => 'Laissez toujours de l eau propre et fraiche a disposition, surtout par temps chaud, apres l exercice ou avec une alimentation seche. Si votre animal boit soudainement beaucoup moins ou beaucoup plus, demandez conseil a un veterinaire.',
                ];
            }

            return [
                'in_scope' => true,
                'answer' => 'Always keep clean fresh water available, especially in hot weather, after exercise, or with dry food. If your pet suddenly drinks much less or much more than usual, ask a veterinarian.',
            ];
        }

        if ($this->matches($question, ['parasite', 'parasites', 'flea', 'flea', 'tick', 'ticks', 'worm', 'worms', 'vermif', 'puce', 'puces', 'tique', 'tiques', 'prevention', 'preventive', 'preventif', 'checkup', 'controle', 'contrôle'])) {
            if ($locale === 'fr') {
                return [
                    'in_scope' => true,
                    'answer' => 'La prevention de base comprend les vaccins a jour, l antiparasitaire regulier et un controle veterinaire de routine. Le rythme exact depend de l age, du mode de vie et de la zone ou vit l animal.',
                ];
            }

            return [
                'in_scope' => true,
                'answer' => 'Basic prevention includes current vaccines, regular parasite control, and routine veterinary checkups. The exact schedule depends on the pet\'s age, lifestyle, and local risk.',
            ];
        }

        if ($locale === 'fr') {
            return [
                'in_scope' => false,
                'answer' => 'Je peux aider seulement pour les vaccins, l alimentation, les aliments toxiques, l hydratation et la prevention de base. Pour les symptomes, les blessures ou un traitement, contactez un veterinaire.',
            ];
        }

        return [
            'in_scope' => false,
            'answer' => 'I can only help with vaccines, feeding, toxic foods, hydration, and basic prevention. For symptoms, injuries, or treatment, please contact a veterinarian.',
        ];
    }

    private function normalizeLocale(string $locale): string
    {
        return str_starts_with(strtolower($locale), 'fr') ? 'fr' : 'en';
    }

    private function detectResponseLocale(string $question, string $locale): string
    {
        if (preg_match('/\b(le|la|les|des|mon|ma|pour|avec|chien|chat|vaccin|manger|nourriture|eau)\b/u', mb_strtolower($question)) === 1) {
            return 'fr';
        }

        return $this->normalizeLocale($locale);
    }

    private function isGreeting(string $question): bool
    {
        return preg_match('/^(hi|hello|hey|good morning|good afternoon|good evening|bonjour|salut|bonsoir|coucou)\b/i', trim($question)) === 1;
    }

    private function cleanText(string $value): string
    {
        return trim((string) preg_replace('/\s+/', ' ', $value));
    }

    /**
     * @param list<string> $keywords
     */
    private function matches(string $question, array $keywords): bool
    {
        foreach ($keywords as $keyword) {
            if (str_contains($question, $keyword)) {
                return true;
            }
        }

        return false;
    }

    private function limitText(string $value, int $length): string
    {
        if (mb_strlen($value) <= $length) {
            return $value;
        }

        return rtrim(mb_substr($value, 0, max(0, $length - 3))).'...';
    }
}
