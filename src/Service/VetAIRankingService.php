<?php
namespace App\Service;

use App\Entity\User;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class VetAIRankingService
{
    public function __construct(
        private HttpClientInterface $http,
        private string $groqApiKey = ''
    ) {
    }

    /**
     * @param list<array{
     *     vet: User,
     *     stats: array{note_moyenne: float, nombre_avis: int, taux_satisfaction: float|int, etoiles?: float}
     * }> $vetsAvecStats
     *
     * @return array{top3: list<array{nom: string, justification: string}>}
     */
    public function getTop3(array $vetsAvecStats): array
    {
        if ($vetsAvecStats === []) {
            return ['top3' => []];
        }

        if ($this->groqApiKey === '') {
            return $this->buildFallbackTop3($vetsAvecStats);
        }

        try {
            $response = $this->http->request('POST', 'https://api.groq.com/openai/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->groqApiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'llama3-8b-8192',
                    'temperature' => 0.3,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'Tu es un assistant pour une clinique veterinaire. Reponds uniquement en JSON valide.',
                        ],
                        [
                            'role' => 'user',
                            'content' => $this->buildPrompt($vetsAvecStats),
                        ],
                    ],
                ],
            ]);

            $data = $response->toArray(false);
            $content = $data['choices'][0]['message']['content'] ?? '';
            $decoded = json_decode(trim((string) $content), true);

            if (is_array($decoded) && isset($decoded['top3']) && is_array($decoded['top3'])) {
                $top3 = [];

                foreach (array_slice($decoded['top3'], 0, 3) as $item) {
                    if (!is_array($item)) {
                        continue;
                    }

                    $top3[] = [
                        'nom' => (string) ($item['nom'] ?? ''),
                        'justification' => (string) ($item['justification'] ?? ''),
                    ];
                }

                return ['top3' => $top3];
            }
        } catch (\Throwable) {
        }

        return $this->buildFallbackTop3($vetsAvecStats);
    }

    /**
     * @param list<array{
     *     vet: User,
     *     stats: array{note_moyenne: float, nombre_avis: int, taux_satisfaction: float|int, etoiles?: float}
     * }> $vetsAvecStats
     */
    private function buildPrompt(array $vetsAvecStats): string
    {
        $dataTexte = '';

        foreach ($vetsAvecStats as $item) {
            $vet = $item['vet'];
            $stats = $item['stats'];
            $dataTexte .= sprintf(
                "- Dr. %s %s : note %.1f/5, %d avis, satisfaction %d%%\n",
                $vet->getFirstName(),
                $vet->getLastName(),
                $stats['note_moyenne'],
                $stats['nombre_avis'],
                $stats['taux_satisfaction']
            );
        }

        return <<<PROMPT
Voici les veterinaires:
{$dataTexte}

Retourne uniquement ce JSON:
{"top3":[{"nom":"Dr. Prenom Nom","justification":"..."},{"nom":"...","justification":"..."},{"nom":"...","justification":"..."}]}
PROMPT;
    }

    /**
     * @param list<array{
     *     vet: User,
     *     stats: array{note_moyenne: float, nombre_avis: int, taux_satisfaction: float|int, etoiles?: float}
     * }> $vetsAvecStats
     *
     * @return array{top3: list<array{nom: string, justification: string}>}
     */
    private function buildFallbackTop3(array $vetsAvecStats): array
    {
        usort($vetsAvecStats, static function (array $left, array $right): int {
            $leftStats = $left['stats'];
            $rightStats = $right['stats'];

            return [$rightStats['note_moyenne'], $rightStats['nombre_avis'], $rightStats['taux_satisfaction']]
                <=> [$leftStats['note_moyenne'], $leftStats['nombre_avis'], $leftStats['taux_satisfaction']];
        });

        $top3 = array_map(static function (array $item): array {
            $vet = $item['vet'];
            $stats = $item['stats'];

            return [
                'nom' => sprintf('Dr. %s %s', $vet->getFirstName(), $vet->getLastName()),
                'justification' => sprintf(
                    'Classe selon la note moyenne (%s/5), le nombre d avis (%d) et la satisfaction (%d%%).',
                    $stats['note_moyenne'],
                    $stats['nombre_avis'],
                    $stats['taux_satisfaction']
                ),
            ];
        }, array_slice($vetsAvecStats, 0, 3));

        return ['top3' => $top3];
    }
}
