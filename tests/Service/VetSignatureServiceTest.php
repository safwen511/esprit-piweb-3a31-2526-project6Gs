<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\User;
use App\Service\VetSignatureService;
use PHPUnit\Framework\TestCase;

final class VetSignatureServiceTest extends TestCase
{
    public function testApprovedVeterinaireRequiresSignatureChallenge(): void
    {
        $user = (new User())
            ->setRoles(['ROLE_VETERINAIRE'])
            ->setIsVeteranApproved(true);

        self::assertTrue((new VetSignatureService())->requiresSignatureChallenge($user));
    }

    public function testStoredSignatureCanBeVerifiedWithSameShape(): void
    {
        $service = new VetSignatureService();
        $user = new User();
        $points = $this->signaturePoints();

        $service->storeSignature($user, $points);
        $result = $service->verifySignature($user, $points);

        self::assertTrue($service->hasStoredSignature($user));
        self::assertTrue($result['matched']);
        self::assertLessThanOrEqual($result['threshold'], $result['score']);
    }

    /**
     * @return list<array{x: float, y: float}>
     */
    private function signaturePoints(): array
    {
        $points = [];
        for ($i = 0; $i < 50; ++$i) {
            $points[] = [
                'x' => (float) ($i * 4),
                'y' => (float) (50 + sin($i / 3) * 30),
            ];
        }

        return $points;
    }
}
