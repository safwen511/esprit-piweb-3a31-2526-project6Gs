<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

final class SocialPostMediaUploader
{
    public function __construct(
        private readonly SluggerInterface $slugger,
        #[Autowire('%kernel.project_dir%')]
        private readonly string $projectDir,
    ) {
    }

    /**
     * @throws FileException
     */
    public function upload(UploadedFile $mediaFile): string
    {
        $originalName = pathinfo($mediaFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = (string) $this->slugger->slug($originalName !== '' ? $originalName : 'animal-update');
        $extension = $mediaFile->guessExtension() ?: $mediaFile->getClientOriginalExtension() ?: 'bin';
        $filename = sprintf(
            'uploads/social/%s-%s.%s',
            $safeName,
            uniqid('', true),
            strtolower($extension),
        );

        $targetDirectory = $this->projectDir.'/public/uploads/social';
        if (!is_dir($targetDirectory) && !mkdir($targetDirectory, 0777, true) && !is_dir($targetDirectory)) {
            throw new FileException('Unable to create social media upload directory.');
        }

        $mediaFile->move(
            $targetDirectory,
            basename($filename),
        );

        return $filename;
    }

    public function detectMediaType(UploadedFile $mediaFile): string
    {
        $mimeType = (string) ($mediaFile->getClientMimeType() ?: $mediaFile->getMimeType());

        if (str_starts_with($mimeType, 'video/')) {
            return 'VIDEO';
        }

        return 'IMAGE';
    }
}
