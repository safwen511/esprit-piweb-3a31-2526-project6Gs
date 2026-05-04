<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\AnimalImagePredictionService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class AnimalImagePredictionServiceTest extends TestCase
{
    public function testPredictionNormalizesConfidenceAndAlternatives(): void
    {
        $file = $this->temporaryUpload();
        $client = new MockHttpClient([
            new MockResponse(json_encode([
                'is_animal' => true,
                'message' => 'ok',
                'animal_confidence' => 1.4,
                'species' => ['label' => 'Dog', 'confidence' => -0.2],
                'breed' => ['label' => 'Labrador', 'confidence' => 0.87],
                'species_alternatives' => [
                    ['label' => 'Cat', 'confidence' => 0.2],
                    'bad row',
                ],
                'breed_alternatives' => [
                    ['label' => 'Retriever', 'confidence' => 2.0],
                ],
            ], JSON_THROW_ON_ERROR)),
        ]);

        $prediction = (new AnimalImagePredictionService($client))->predictFromUpload($file);

        self::assertTrue($prediction['is_animal']);
        self::assertSame(1.0, $prediction['animal_confidence']);
        self::assertSame(['label' => 'Dog', 'confidence' => 0.0], $prediction['species']);
        self::assertSame([['label' => 'Retriever', 'confidence' => 1.0]], $prediction['breed_alternatives']);
    }

    public function testDescriptionGenerationReturnsNullableSpeciesAndDefaultNote(): void
    {
        $client = new MockHttpClient([
            new MockResponse(json_encode([
                'description' => 'Gentle kitten ready for adoption.',
                'species' => 'Cat',
            ], JSON_THROW_ON_ERROR)),
        ]);

        $result = (new AnimalImagePredictionService($client))->generateDescription([
            'name' => 'Milo',
            'species' => 'cat',
        ]);

        self::assertSame('Gentle kitten ready for adoption.', $result['description']);
        self::assertSame('Cat', $result['species']);
        self::assertNull($result['breed']);
        self::assertSame('Description generated.', $result['confidence_note']);
    }

    private function temporaryUpload(): UploadedFile
    {
        $path = tempnam(sys_get_temp_dir(), 'animal-ai-');
        self::assertIsString($path);
        file_put_contents($path, 'image-bytes');

        return new UploadedFile($path, 'animal.jpg', 'image/jpeg', null, true);
    }
}
