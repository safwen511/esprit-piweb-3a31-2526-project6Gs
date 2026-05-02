<?php
namespace App\Service;

use App\Entity\User;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class VetService
{
    public function __construct(
        private HttpClientInterface $http,
        private string $groqApiKey
    ) {}

    /**
     * @param list<array{vet: User, stats: array{note_moyenne: float, nombre_avis: int, taux_satisfaction: float|int, etoiles: float}}> $vetsAvecStats
     *
     * @return array{top3: list<array{nom: string, justification: string}>}
     */
    public function getTop3(array $vetsAvecStats): array
    {
        $dataTexte = '';
        foreach ($vetsAvecStats as $item) {
            $vet   = $item['vet'];
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

        $response = $this->http->request('POST', 'https://api.groq.com/openai/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->groqApiKey,
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'model'       => 'llama3-8b-8192',
                'temperature' => 0.3,
                'messages'    => [
                    [
                        'role'    => 'system',
                        'content' => 'Tu es un assistant pour une clinique vétérinaire. Réponds UNIQUEMENT en JSON valide, sans markdown, sans texte avant ou après.'
                    ],
                    [
                        'role'    => 'user',
                        'content' => "Voici les vétérinaires :\n{$dataTexte}\n
Retourne le top 3 uniquement en JSON :
{\"top3\":[{\"nom\":\"Dr. Prénom Nom\",\"justification\":\"...\"},{\"nom\":\"...\",\"justification\":\"...\"},{\"nom\":\"...\",\"justification\":\"...\"}]}"
                    ]
                ],
            ]
        ]);

        $data    = $response->toArray();
        $content = $data['choices'][0]['message']['content'];
        $decoded = json_decode(trim($content), true);

        return is_array($decoded) && isset($decoded['top3']) && is_array($decoded['top3'])
            ? ['top3' => $this->normalizeTop3($decoded['top3'])]
            : ['top3' => []];
    }

    /**
     * @param array<mixed> $items
     *
     * @return list<array{nom: string, justification: string}>
     */
    private function normalizeTop3(array $items): array
    {
        $top3 = [];
        foreach ($items as $item) {
            if (!is_array($item)) {
                continue;
            }

            $name = trim((string) ($item['nom'] ?? ''));
            if ($name === '') {
                continue;
            }

            $top3[] = [
                'nom' => $name,
                'justification' => trim((string) ($item['justification'] ?? '')),
            ];

            if (count($top3) === 3) {
                break;
            }
        }

        return $top3;
    }
}
