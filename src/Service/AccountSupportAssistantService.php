<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class AccountSupportAssistantService
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $anthropicApiKey = '',
        private readonly string $anthropicModel = 'claude-sonnet-4-20250514',
        private readonly string $groqApiKey = '',
        private readonly string $groqModel = 'llama-3.3-70b-versatile',
    ) {
    }

    /**
     * @return array{resolved: bool, answer: string}
     */
    public function answerQuestion(string $question, string $locale, array $history = []): array
    {
        $question = $this->cleanText($question);
        $locale = $this->normalizeLocale($locale);
        $history = $this->sanitizeHistory($history);

        if ($question === '' || mb_strlen($question) < 3) {
            throw new \InvalidArgumentException('Please describe the problem in a short sentence.');
        }

        $systemPrompt = 'You are a concise account-access support assistant for a web app. You help users who cannot sign in due to blocked/deactivated accounts or related login issues. Use conversation context when provided. Do not invent internal policy. If user action likely fixes it (email typo/password reset), set resolved=true. If admin review is needed, set resolved=false and tell them to request admin intervention. Keep replies to 2-4 short sentences. Return valid JSON only with keys resolved and answer.';
        $userPrompt = $this->buildPrompt($locale, $question, $history);

        $content = $this->requestAssistantCompletion($systemPrompt, $userPrompt, 0.2, 360);
        if ($content !== null) {
            $decoded = $this->decodeAssistantResponse($content);
            if ($decoded !== null) {
                return $decoded;
            }
        }

        return $this->buildFallbackResponse($question, $locale);
    }

    /**
     * @return array{
     *     approved: bool,
     *     confidence: float,
     *     summary: string,
     *     user_message: string,
     *     escalate: bool
     * }
     */
    public function evaluateUnblockAppeal(User $user, string $details, string $locale, array $history = []): array
    {
        $details = $this->cleanText($details);
        $locale = $this->normalizeLocale($locale);
        $history = $this->sanitizeHistory($history);

        if ($details === '' || mb_strlen($details) < 12) {
            throw new \InvalidArgumentException('Please explain why your account should be unblocked in a little more detail.');
        }

        if ($this->isSensitiveAccount($user)) {
            return [
                'approved' => false,
                'confidence' => 0.0,
                'summary' => $locale === 'fr'
                    ? 'Compte sensible detecte, verification humaine requise.'
                    : 'Sensitive account detected, human review required.',
                'user_message' => $locale === 'fr'
                    ? 'Votre demande a ete envoyee a un administrateur, car ce type de compte demande une verification humaine.'
                    : 'Your request was sent to an administrator because this type of account requires human review.',
                'escalate' => true,
            ];
        }

        $systemPrompt = 'You review unblock appeals for blocked web-app accounts. Be conservative. Approve only when the explanation is specific, accountable, low-risk, and shows corrective action. Never approve if the user admits spam, fraud, threats, harassment, bots, account sharing, repeated abuse, or evasion. Sensitive accounts like admins or vets must be escalated. Return valid JSON only with keys approved, confidence, summary, user_message, escalate.';
        $userPrompt = $this->buildAppealPrompt($user, $details, $locale, $history);

        $content = $this->requestAssistantCompletion($systemPrompt, $userPrompt, 0.1, 420);
        if ($content !== null) {
            $decoded = $this->decodeAppealResponse($content, $locale);
            if ($decoded !== null) {
                return $decoded;
            }
        }

        return $this->buildFallbackAppealDecision($user, $details, $locale);
    }

    private function requestAssistantCompletion(string $systemPrompt, string $userPrompt, float $temperature, int $maxTokens): ?string
    {
        $content = $this->requestAnthropicCompletion($systemPrompt, $userPrompt, $temperature, $maxTokens);
        if ($content !== null) {
            return $content;
        }

        return $this->requestGroqCompletion($systemPrompt, $userPrompt, $temperature);
    }

    private function requestAnthropicCompletion(string $systemPrompt, string $userPrompt, float $temperature, int $maxTokens): ?string
    {
        if ($this->anthropicApiKey === '') {
            return null;
        }

        try {
            $response = $this->httpClient->request('POST', 'https://api.anthropic.com/v1/messages', [
                'headers' => [
                    'x-api-key' => $this->anthropicApiKey,
                    'anthropic-version' => '2023-06-01',
                    'content-type' => 'application/json',
                ],
                'timeout' => 20,
                'json' => [
                    'model' => $this->anthropicModel,
                    'max_tokens' => $maxTokens,
                    'temperature' => $temperature,
                    'system' => $systemPrompt,
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $userPrompt,
                        ],
                    ],
                ],
            ]);

            $payload = $response->toArray(false);
            $blocks = $payload['content'] ?? null;
            if (!is_array($blocks)) {
                return null;
            }

            $text = '';
            foreach ($blocks as $block) {
                if (is_array($block) && ($block['type'] ?? null) === 'text' && isset($block['text'])) {
                    $text .= (string) $block['text'];
                }
            }

            $text = trim($text);

            return $text !== '' ? $text : null;
        } catch (ExceptionInterface|\Throwable) {
            return null;
        }
    }

    private function requestGroqCompletion(string $systemPrompt, string $userPrompt, float $temperature): ?string
    {
        if ($this->groqApiKey === '') {
            return null;
        }

        try {
            $response = $this->httpClient->request('POST', 'https://api.groq.com/openai/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer '.$this->groqApiKey,
                    'Content-Type' => 'application/json',
                ],
                'timeout' => 20,
                'json' => [
                    'model' => $this->groqModel,
                    'temperature' => $temperature,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => $systemPrompt,
                        ],
                        [
                            'role' => 'user',
                            'content' => $userPrompt,
                        ],
                    ],
                ],
            ]);

            $payload = $response->toArray(false);
            $content = trim((string) ($payload['choices'][0]['message']['content'] ?? ''));

            return $content !== '' ? $content : null;
        } catch (ExceptionInterface|\Throwable) {
            return null;
        }
    }

    /**
     * @param array<int, array{role: string, content: string}> $history
     */
    private function buildPrompt(string $locale, string $question, array $history): string
    {
        $historyLines = [];
        foreach ($history as $entry) {
            $historyLines[] = sprintf('%s: %s', $entry['role'], $entry['content']);
        }

        $historyBlock = $historyLines === [] ? 'No previous conversation.' : implode("\n", $historyLines);

        return sprintf(
            "Locale: %s\nConversation so far:\n%s\n\nCurrent user message: %s\n\nReturn JSON only with exact shape: {\"resolved\":true|false,\"answer\":\"...\"}",
            $locale,
            $historyBlock,
            $question
        );
    }

    /**
     * @param array<int, array{role: string, content: string}> $history
     */
    private function buildAppealPrompt(User $user, string $details, string $locale, array $history): string
    {
        $historyLines = [];
        foreach ($history as $entry) {
            $historyLines[] = sprintf('%s: %s', $entry['role'], $entry['content']);
        }

        $historyBlock = $historyLines === [] ? 'No previous conversation.' : implode("\n", $historyLines);

        return sprintf(
            "Locale: %s\nUser type: %s\nApproved vet: %s\nActive account: %s\nConversation so far:\n%s\n\nAppeal:\n%s\n\nApprove only if the appeal is low-risk, specific, and accountable. Return JSON only with exact shape: {\"approved\":true|false,\"confidence\":0.0,\"summary\":\"...\",\"user_message\":\"...\",\"escalate\":true|false}",
            $locale,
            implode(', ', $user->getRoles()),
            $user->isVeteranApproved() ? 'yes' : 'no',
            $user->isActive() ? 'yes' : 'no',
            $historyBlock,
            $details
        );
    }

    /**
     * @return array{resolved: bool, answer: string}|null
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
        if (!is_array($decoded) || !array_key_exists('resolved', $decoded) || !array_key_exists('answer', $decoded)) {
            return null;
        }

        $answer = $this->cleanText((string) $decoded['answer']);
        if ($answer === '') {
            return null;
        }

        return [
            'resolved' => (bool) $decoded['resolved'],
            'answer' => $this->limitText($answer, 500),
        ];
    }

    /**
     * @return array{
     *     approved: bool,
     *     confidence: float,
     *     summary: string,
     *     user_message: string,
     *     escalate: bool
     * }|null
     */
    private function decodeAppealResponse(string $content, string $locale): ?array
    {
        $content = trim($content);
        if ($content === '') {
            return null;
        }

        if (str_starts_with($content, '```')) {
            $content = preg_replace('/^```(?:json)?\s*|\s*```$/', '', $content) ?? $content;
        }

        $decoded = json_decode(trim($content), true);
        if (
            !is_array($decoded)
            || !array_key_exists('approved', $decoded)
            || !array_key_exists('confidence', $decoded)
            || !array_key_exists('summary', $decoded)
            || !array_key_exists('user_message', $decoded)
            || !array_key_exists('escalate', $decoded)
        ) {
            return null;
        }

        $summary = $this->cleanText((string) $decoded['summary']);
        $userMessage = $this->cleanText((string) $decoded['user_message']);
        if ($summary === '' || $userMessage === '') {
            return null;
        }

        $confidence = max(0.0, min(1.0, (float) $decoded['confidence']));
        $approved = (bool) $decoded['approved'];
        $escalate = (bool) $decoded['escalate'];

        if ($approved && $confidence < 0.72) {
            $approved = false;
            $escalate = true;
            $userMessage = $locale === 'fr'
                ? 'Votre demande semble recevable, mais une verification humaine est necessaire avant de reouvrir le compte.'
                : 'Your request looks reasonable, but a human review is still needed before reopening the account.';
        }

        return [
            'approved' => $approved,
            'confidence' => $confidence,
            'summary' => $this->limitText($summary, 160),
            'user_message' => $this->limitText($userMessage, 280),
            'escalate' => $approved ? false : $escalate,
        ];
    }

    /**
     * @return array{resolved: bool, answer: string}
     */
    private function buildFallbackResponse(string $question, string $locale): array
    {
        $q = mb_strtolower($question);

        if (str_contains($q, 'why') && (str_contains($q, 'blocked') || str_contains($q, 'deactivated'))) {
            return [
                'resolved' => false,
                'answer' => $locale === 'fr'
                    ? 'Je ne peux pas voir la raison interne exacte du blocage depuis ce chat. Je peux vous aider a verifier email et mot de passe, puis vous pouvez demander l intervention admin pour une verification officielle.'
                    : 'I cannot see the internal exact reason for the block from this chat. I can help verify your email/password steps, then you can request admin intervention for an official review.',
            ];
        }

        if (str_contains($q, 'wrong password') || str_contains($q, 'mot de passe')) {
            return [
                'resolved' => true,
                'answer' => $locale === 'fr'
                    ? 'Essayez d abord la reinitialisation du mot de passe depuis la page de connexion. Si le compte reste bloque apres cela, envoyez une demande d intervention admin ci-dessous.'
                    : 'First try password reset from the login page. If your account is still blocked after that, send an admin intervention request below.',
            ];
        }

        if (str_contains($q, 'email') || str_contains($q, 'mail')) {
            return [
                'resolved' => true,
                'answer' => $locale === 'fr'
                    ? 'Verifiez que vous utilisez le meme email que lors de l inscription, sans espace. Ensuite reessayez la connexion.'
                    : 'Confirm you are using the exact registration email with no extra spaces, then try logging in again.',
            ];
        }

        return [
            'resolved' => false,
            'answer' => $locale === 'fr'
                ? 'Je n ai pas assez d informations pour corriger cela automatiquement. Utilisez le bouton d intervention admin et decrivez ce qui se passe; un administrateur vous repondra.'
                : 'I do not have enough information to fix this automatically. Use the admin intervention button and describe what is happening; an admin will follow up.',
        ];
    }

    /**
     * @return array{
     *     approved: bool,
     *     confidence: float,
     *     summary: string,
     *     user_message: string,
     *     escalate: bool
     * }
     */
    private function buildFallbackAppealDecision(User $user, string $details, string $locale): array
    {
        if ($this->isSensitiveAccount($user)) {
            return [
                'approved' => false,
                'confidence' => 0.0,
                'summary' => $locale === 'fr'
                    ? 'Compte sensible, revision manuelle requise.'
                    : 'Sensitive account, manual review required.',
                'user_message' => $locale === 'fr'
                    ? 'Votre demande a ete transmise a un administrateur pour verification.'
                    : 'Your request was sent to an administrator for review.',
                'escalate' => true,
            ];
        }

        $normalized = mb_strtolower($details);
        $riskTerms = [
            'spam',
            'fraud',
            'scam',
            'bot',
            'abuse',
            'harass',
            'threat',
            'hack',
            'fake account',
            'multiple accounts',
            'ban evasion',
        ];

        foreach ($riskTerms as $term) {
            if (str_contains($normalized, $term)) {
                return [
                    'approved' => false,
                    'confidence' => 0.9,
                    'summary' => $locale === 'fr'
                        ? 'Le message contient un indicateur de risque et demande une verification humaine.'
                        : 'The appeal contains a risk indicator and needs human review.',
                    'user_message' => $locale === 'fr'
                        ? 'Votre demande a ete envoyee a un administrateur pour examen plus approfondi.'
                        : 'Your request was sent to an administrator for closer review.',
                    'escalate' => true,
                ];
            }
        }

        $positiveSignals = 0;
        foreach ([
            'mistake',
            'error',
            'sorry',
            'apolog',
            'again',
            'follow the rules',
            'understand',
            'verify',
            'please review',
            'will not happen',
        ] as $signal) {
            if (str_contains($normalized, $signal)) {
                ++$positiveSignals;
            }
        }

        if (mb_strlen($details) >= 40 && $positiveSignals >= 2) {
            return [
                'approved' => true,
                'confidence' => 0.74,
                'summary' => $locale === 'fr'
                    ? 'Appel detaille, cooperatif et sans risque evident.'
                    : 'Detailed, cooperative appeal with no obvious risk indicators.',
                'user_message' => $locale === 'fr'
                    ? 'Votre compte peut etre reactive maintenant. Merci de respecter les regles lors de la prochaine connexion.'
                    : 'Your account can be reactivated now. Please follow the platform rules when you sign in again.',
                'escalate' => false,
            ];
        }

        return [
            'approved' => false,
            'confidence' => 0.42,
            'summary' => $locale === 'fr'
                ? 'Appel insuffisant pour une reactivation automatique.'
                : 'Appeal was not strong enough for automatic reactivation.',
            'user_message' => $locale === 'fr'
                ? 'Votre demande a ete transmise a un administrateur pour examen.'
                : 'Your request was forwarded to an administrator for review.',
            'escalate' => true,
        ];
    }

    private function isSensitiveAccount(User $user): bool
    {
        return in_array('ROLE_ADMIN', $user->getRoles(), true)
            || in_array('ROLE_VETERINAIRE', $user->getRoles(), true)
            || $user->isVeteranApproved();
    }

    private function normalizeLocale(string $locale): string
    {
        return str_starts_with(strtolower($locale), 'fr') ? 'fr' : 'en';
    }

    /**
     * @param array<mixed> $history
     * @return array<int, array{role: string, content: string}>
     */
    private function sanitizeHistory(array $history): array
    {
        $sanitized = [];

        foreach ($history as $entry) {
            if (!is_array($entry)) {
                continue;
            }

            $role = isset($entry['role']) ? strtolower(trim((string) $entry['role'])) : 'user';
            if (!in_array($role, ['user', 'assistant'], true)) {
                $role = 'user';
            }

            $content = $this->cleanText((string) ($entry['content'] ?? ''));
            if ($content === '') {
                continue;
            }

            $sanitized[] = [
                'role' => $role,
                'content' => $this->limitText($content, 360),
            ];

            if (count($sanitized) >= 12) {
                break;
            }
        }

        return $sanitized;
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
