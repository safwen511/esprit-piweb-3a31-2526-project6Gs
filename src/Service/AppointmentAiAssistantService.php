<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class AppointmentAiAssistantService
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $groqApiKey = '',
    ) {
    }

    /**
     * @return array{
     *     suggested_note: string,
     *     intake_summary: string,
     *     checklist: list<string>
     * }
     */
    public function assistBookingRequest(
        string $description,
        ?string $animalName,
        ?string $animalType,
        string $locale,
    ): array {
        $locale = $this->normalizeLocale($locale);
        $description = $this->cleanText($description);

        if ($description === '') {
            throw new \InvalidArgumentException('appointments.ai.description_required');
        }

        if ($this->groqApiKey !== '') {
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
                                'content' => 'You help pet owners prepare a clearer veterinary appointment request. Do not diagnose, prescribe, or recommend treatment. Return valid JSON only.',
                            ],
                            [
                                'role' => 'user',
                                'content' => $this->buildPrompt($description, $animalName, $animalType, $locale),
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
        }

        return $this->buildFallback($description, $animalName, $animalType, $locale);
    }

    /**
     * @return array{
     *     suggested_note: string,
     *     intake_summary: string,
     *     checklist: list<string>
     * }
     */
    public function buildLocalSuggestion(
        string $description,
        ?string $animalName,
        ?string $animalType,
        string $locale,
    ): array {
        return $this->buildFallback(
            $this->cleanText($description),
            $animalName !== null ? $this->cleanText($animalName) : null,
            $animalType !== null ? $this->cleanText($animalType) : null,
            $this->normalizeLocale($locale),
        );
    }

    private function buildPrompt(string $description, ?string $animalName, ?string $animalType, string $locale): string
    {
        $animalContext = trim(sprintf(
            '%s%s',
            $animalName ? 'Name: '.$animalName.'. ' : '',
            $animalType ? 'Species: '.$animalType.'.' : ''
        ));

        return sprintf(
            <<<PROMPT
Locale: %s
Animal: %s
Raw booking note: %s

Rewrite the booking request in the requested locale for a veterinarian.
Return valid JSON only with this exact structure:
{"suggested_note":"...","intake_summary":"...","checklist":["...","...","..."]}

Rules:
- keep the same meaning as the raw note
- do not diagnose
- do not recommend treatment
- checklist must contain 2 or 3 short items
- no markdown
PROMPT,
            $locale,
            $animalContext !== '' ? $animalContext : 'No extra animal context provided.',
            $description,
        );
    }

    /**
     * @return array{suggested_note: string, intake_summary: string, checklist: list<string>}|null
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
        if (!is_array($decoded)) {
            return null;
        }

        $suggestedNote = $this->cleanText((string) ($decoded['suggested_note'] ?? ''));
        $intakeSummary = $this->cleanText((string) ($decoded['intake_summary'] ?? ''));
        $checklist = array_values(array_filter(array_map(
            fn (mixed $item): string => $this->cleanText(is_scalar($item) ? (string) $item : ''),
            is_array($decoded['checklist'] ?? null) ? $decoded['checklist'] : []
        )));

        if ($suggestedNote === '' || $intakeSummary === '' || count($checklist) < 2) {
            return null;
        }

        return [
            'suggested_note' => $suggestedNote,
            'intake_summary' => $intakeSummary,
            'checklist' => array_slice($checklist, 0, 3),
        ];
    }

    /**
     * @return array{suggested_note: string, intake_summary: string, checklist: list<string>}
     */
    private function buildFallback(string $description, ?string $animalName, ?string $animalType, string $locale): array
    {
        $animalLabel = $this->animalLabel($animalName, $animalType, $locale);
        $shortDescription = $this->limitText($description, 170);

        if ($locale === 'fr') {
            return [
                'suggested_note' => sprintf(
                    'Demande de rendez-vous pour %s. Motif principal : %s',
                    $animalLabel,
                    $description
                ),
                'intake_summary' => sprintf(
                    'Consultation demandee pour %s. Le client souhaite de l aide pour : %s',
                    $animalLabel,
                    $shortDescription
                ),
                'checklist' => [
                    'Preciser depuis quand le probleme a commence.',
                    'Indiquer les changements visibles dans le comportement, l appetit ou l energie.',
                    'Mentionner les traitements ou antecedents deja connus.',
                ],
            ];
        }

        return [
            'suggested_note' => sprintf(
                'Appointment request for %s. Main reason: %s',
                $animalLabel,
                $description
            ),
            'intake_summary' => sprintf(
                'Consultation requested for %s. The client needs help with: %s',
                $animalLabel,
                $shortDescription
            ),
            'checklist' => [
                'Mention when the issue started.',
                'Add visible changes in behaviour, appetite, or energy.',
                'Mention any current medication or relevant history.',
            ],
        ];
    }

    private function animalLabel(?string $animalName, ?string $animalType, string $locale): string
    {
        $animalName = $this->cleanText((string) $animalName);
        $animalType = $this->cleanText((string) $animalType);

        if ($animalName !== '' && $animalType !== '') {
            return sprintf('%s (%s)', $animalName, $animalType);
        }

        if ($animalName !== '') {
            return $animalName;
        }

        if ($animalType !== '') {
            return $animalType;
        }

        return $locale === 'fr' ? 'l animal du client' : 'the client\'s pet';
    }

    private function normalizeLocale(string $locale): string
    {
        return str_starts_with(strtolower($locale), 'fr') ? 'fr' : 'en';
    }

    private function cleanText(string $value): string
    {
        return trim((string) preg_replace('/\s+/', ' ', $value));
    }

    private function limitText(string $value, int $length): string
    {
        if (mb_strlen($value) <= $length) {
            return $value;
        }

        return rtrim(mb_substr($value, 0, max(0, $length - 3))).'...';
    }
}
