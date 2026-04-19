<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class VoiceSampleUploader
{
    public function __construct(
        #[Autowire('%kernel.project_dir%')]
        private readonly string $projectDir,
    ) {
    }

    public function upload(User $user, UploadedFile $file): string
    {
        $directory = $this->projectDir.'/public/uploads/voice';

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $extension = $file->guessExtension() ?: 'webm';
        $filename = sprintf(
            'voice-user-%d-%s.%s',
            $user->getId(),
            bin2hex(random_bytes(8)),
            $extension,
        );

        $file->move($directory, $filename);

        return 'uploads/voice/'.$filename;
    }

    public function delete(?string $relativePath): void
    {
        if ($relativePath === null || $relativePath === '') {
            return;
        }

        $fullPath = $this->projectDir.'/public/'.ltrim($relativePath, '/');
        if (is_file($fullPath)) {
            unlink($fullPath);
        }
    }

    public function resolveAbsolutePath(string $relativePath): string
    {
        return $this->projectDir.'/public/'.ltrim($relativePath, '/');
    }
}
