<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class VetSignatureService
{
    public const VERIFICATION_SESSION_KEY = 'vet_signature_verified';
    public const TARGET_PATH_SESSION_KEY = 'vet_signature_target_path';

    private const MINIMUM_INPUT_POINTS = 40;
    private const RESAMPLED_POINT_COUNT = 48;
    private const MINIMUM_BOUNDING_BOX = 18.0;
    private const MINIMUM_PATH_LENGTH = 80.0;
    private const MATCH_THRESHOLD = 0.24;

    public function requiresSignatureChallenge(User $user): bool
    {
        return $user->isVeteranApproved() && in_array('ROLE_VETERINAIRE', $user->getRoles(), true);
    }

    public function hasStoredSignature(User $user): bool
    {
        return $this->decodeSignature($user->getSignature()) !== null;
    }

    public function getMinimumInputPoints(): int
    {
        return self::MINIMUM_INPUT_POINTS;
    }

    public function isVerified(SessionInterface $session): bool
    {
        return (bool) $session->get(self::VERIFICATION_SESSION_KEY, false);
    }

    public function markVerified(SessionInterface $session): void
    {
        $session->set(self::VERIFICATION_SESSION_KEY, true);
    }

    public function clearVerificationState(SessionInterface $session): void
    {
        $session->remove(self::VERIFICATION_SESSION_KEY);
        $session->remove(self::TARGET_PATH_SESSION_KEY);
    }

    public function rememberTargetPath(SessionInterface $session, string $path): void
    {
        if (str_starts_with($path, '/')) {
            $session->set(self::TARGET_PATH_SESSION_KEY, $path);
        }
    }

    public function consumeTargetPath(SessionInterface $session): ?string
    {
        $targetPath = $session->get(self::TARGET_PATH_SESSION_KEY);
        $session->remove(self::TARGET_PATH_SESSION_KEY);

        if (!is_string($targetPath) || !str_starts_with($targetPath, '/')) {
            return null;
        }

        return $targetPath;
    }

    /**
     * @param array<int, mixed> $rawPoints
     */
    public function storeSignature(User $user, array $rawPoints): void
    {
        $payload = [
            'version' => 1,
            'points' => $this->buildNormalizedPointSet($rawPoints),
        ];

        $user->setSignature(json_encode($payload, JSON_THROW_ON_ERROR));
    }

    /**
     * @param array<int, mixed> $rawPoints
     *
     * @return array{matched: bool, score: float, threshold: float}
     */
    public function verifySignature(User $user, array $rawPoints): array
    {
        $storedSignature = $this->decodeSignature($user->getSignature());
        if ($storedSignature === null) {
            throw new \RuntimeException('No stored signature was found for this veterinary account.');
        }

        $candidatePoints = $this->buildNormalizedPointSet($rawPoints);
        $score = $this->calculateBestDistance($storedSignature['points'], $candidatePoints);

        return [
            'matched' => $score <= self::MATCH_THRESHOLD,
            'score' => $score,
            'threshold' => self::MATCH_THRESHOLD,
        ];
    }

    /**
     * @param array<int, mixed> $rawPoints
     *
     * @return list<array{x: float, y: float}>
     */
    private function buildNormalizedPointSet(array $rawPoints): array
    {
        $points = $this->extractPoints($rawPoints);
        $resampled = $this->resample($points, self::RESAMPLED_POINT_COUNT);

        return $this->normalize($resampled);
    }

    /**
     * @param mixed $signature
     *
     * @return array{points: list<array{x: float, y: float}>}|null
     */
    private function decodeSignature(mixed $signature): ?array
    {
        if (!is_string($signature) || trim($signature) === '') {
            return null;
        }

        try {
            $decoded = json_decode($signature, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return null;
        }

        if (!is_array($decoded) || !isset($decoded['points']) || !is_array($decoded['points'])) {
            return null;
        }

        $points = [];
        foreach ($decoded['points'] as $point) {
            if (
                !is_array($point)
                || !array_key_exists('x', $point)
                || !array_key_exists('y', $point)
                || !is_numeric($point['x'])
                || !is_numeric($point['y'])
            ) {
                return null;
            }

            $points[] = [
                'x' => (float) $point['x'],
                'y' => (float) $point['y'],
            ];
        }

        if (count($points) !== self::RESAMPLED_POINT_COUNT) {
            return null;
        }

        return ['points' => $points];
    }

    /**
     * @param array<int, mixed> $rawPoints
     *
     * @return list<array{x: float, y: float}>
     */
    private function extractPoints(array $rawPoints): array
    {
        $points = [];

        foreach ($rawPoints as $rawPoint) {
            if (
                !is_array($rawPoint)
                || !array_key_exists('x', $rawPoint)
                || !array_key_exists('y', $rawPoint)
                || !is_numeric($rawPoint['x'])
                || !is_numeric($rawPoint['y'])
            ) {
                continue;
            }

            $x = (float) $rawPoint['x'];
            $y = (float) $rawPoint['y'];

            if (!is_finite($x) || !is_finite($y)) {
                continue;
            }

            $lastPoint = $points[count($points) - 1] ?? null;
            if ($lastPoint !== null && $this->distance($lastPoint, ['x' => $x, 'y' => $y]) < 0.5) {
                continue;
            }

            $points[] = ['x' => $x, 'y' => $y];
        }

        if (count($points) < self::MINIMUM_INPUT_POINTS) {
            throw new \InvalidArgumentException(sprintf('Signature too short. Please draw at least %d points.', self::MINIMUM_INPUT_POINTS));
        }

        $bounds = $this->calculateBounds($points);
        if ($bounds['maxDimension'] < self::MINIMUM_BOUNDING_BOX) {
            throw new \InvalidArgumentException('Signature too small. Please draw across more of the canvas.');
        }

        $pathLength = $this->calculatePathLength($points);
        if ($pathLength < self::MINIMUM_PATH_LENGTH) {
            throw new \InvalidArgumentException('Signature too light. Please draw a fuller signature.');
        }

        return $points;
    }

    /**
     * @param list<array{x: float, y: float}> $points
     *
     * @return list<array{x: float, y: float}>
     */
    private function resample(array $points, int $sampleCount): array
    {
        $distances = [0.0];
        $totalLength = 0.0;

        for ($index = 1, $count = count($points); $index < $count; ++$index) {
            $totalLength += $this->distance($points[$index - 1], $points[$index]);
            $distances[] = $totalLength;
        }

        if ($totalLength <= 0.0) {
            throw new \InvalidArgumentException('Signature path is too short to verify.');
        }

        $step = $totalLength / ($sampleCount - 1);
        $resampled = [$points[0]];
        $targetDistance = $step;
        $segmentIndex = 1;

        while (count($resampled) < $sampleCount - 1) {
            while ($segmentIndex < count($distances) - 1 && $distances[$segmentIndex] < $targetDistance) {
                ++$segmentIndex;
            }

            $previousDistance = $distances[$segmentIndex - 1];
            $nextDistance = $distances[$segmentIndex];
            $segmentSpan = max($nextDistance - $previousDistance, 0.000001);
            $ratio = ($targetDistance - $previousDistance) / $segmentSpan;

            $resampled[] = [
                'x' => $this->interpolate($points[$segmentIndex - 1]['x'], $points[$segmentIndex]['x'], $ratio),
                'y' => $this->interpolate($points[$segmentIndex - 1]['y'], $points[$segmentIndex]['y'], $ratio),
            ];

            $targetDistance += $step;
        }

        $resampled[] = $points[count($points) - 1];

        return $resampled;
    }

    /**
     * @param list<array{x: float, y: float}> $points
     *
     * @return list<array{x: float, y: float}>
     */
    private function normalize(array $points): array
    {
        $centroid = $this->calculateCentroid($points);
        $firstPoint = $points[0];
        $lastPoint = $points[count($points) - 1];
        $angle = atan2($lastPoint['y'] - $firstPoint['y'], $lastPoint['x'] - $firstPoint['x']);
        $cos = cos(-$angle);
        $sin = sin(-$angle);

        $rotated = [];
        foreach ($points as $point) {
            $shiftedX = $point['x'] - $centroid['x'];
            $shiftedY = $point['y'] - $centroid['y'];

            $rotated[] = [
                'x' => ($shiftedX * $cos) - ($shiftedY * $sin),
                'y' => ($shiftedX * $sin) + ($shiftedY * $cos),
            ];
        }

        $bounds = $this->calculateBounds($rotated);
        $scale = max($bounds['maxDimension'], 0.000001);

        return array_map(
            static fn (array $point): array => [
                'x' => round($point['x'] / $scale, 6),
                'y' => round($point['y'] / $scale, 6),
            ],
            $rotated
        );
    }

    /**
     * @param list<array{x: float, y: float}> $left
     * @param list<array{x: float, y: float}> $right
     */
    private function calculateAverageDistance(array $left, array $right): float
    {
        $total = 0.0;
        $count = min(count($left), count($right));

        for ($index = 0; $index < $count; ++$index) {
            $total += $this->distance($left[$index], $right[$index]);
        }

        return $total / max($count, 1);
    }

    /**
     * @param list<array{x: float, y: float}> $left
     * @param list<array{x: float, y: float}> $right
     */
    private function calculateBestDistance(array $left, array $right): float
    {
        $best = $this->calculateAverageDistance($left, $right);
        $best = min($best, $this->calculateAverageDistance($left, array_reverse($right)));

        $count = min(count($left), count($right));
        if ($count < 3) {
            return $best;
        }

        for ($shift = 1; $shift < $count; ++$shift) {
            $best = min($best, $this->calculateAverageDistance($left, $this->rotatePoints($right, $shift)));
            $best = min($best, $this->calculateAverageDistance($left, $this->rotatePoints(array_reverse($right), $shift)));
        }

        return $best;
    }

    /**
     * @param list<array{x: float, y: float}> $points
     *
     * @return array{minX: float, maxX: float, minY: float, maxY: float, maxDimension: float}
     */
    private function calculateBounds(array $points): array
    {
        $minX = $maxX = $points[0]['x'];
        $minY = $maxY = $points[0]['y'];

        foreach ($points as $point) {
            $minX = min($minX, $point['x']);
            $maxX = max($maxX, $point['x']);
            $minY = min($minY, $point['y']);
            $maxY = max($maxY, $point['y']);
        }

        return [
            'minX' => $minX,
            'maxX' => $maxX,
            'minY' => $minY,
            'maxY' => $maxY,
            'maxDimension' => max($maxX - $minX, $maxY - $minY),
        ];
    }

    /**
     * @param list<array{x: float, y: float}> $points
     *
     * @return array{x: float, y: float}
     */
    private function calculateCentroid(array $points): array
    {
        $sumX = 0.0;
        $sumY = 0.0;

        foreach ($points as $point) {
            $sumX += $point['x'];
            $sumY += $point['y'];
        }

        $count = max(count($points), 1);

        return [
            'x' => $sumX / $count,
            'y' => $sumY / $count,
        ];
    }

    /**
     * @param list<array{x: float, y: float}> $points
     */
    private function calculatePathLength(array $points): float
    {
        $length = 0.0;

        for ($index = 1, $count = count($points); $index < $count; ++$index) {
            $length += $this->distance($points[$index - 1], $points[$index]);
        }

        return $length;
    }

    /**
     * @param array{x: float, y: float} $left
     * @param array{x: float, y: float} $right
     */
    private function distance(array $left, array $right): float
    {
        return hypot($left['x'] - $right['x'], $left['y'] - $right['y']);
    }

    private function interpolate(float $start, float $end, float $ratio): float
    {
        return $start + (($end - $start) * $ratio);
    }

    /**
     * @param list<array{x: float, y: float}> $points
     *
     * @return list<array{x: float, y: float}>
     */
    private function rotatePoints(array $points, int $shift): array
    {
        $count = count($points);
        if ($count === 0) {
            return $points;
        }

        $shift = $shift % $count;
        if ($shift === 0) {
            return $points;
        }

        return array_merge(
            array_slice($points, $shift),
            array_slice($points, 0, $shift)
        );
    }
}
