<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProfileImageUploader
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
    public function upload(UploadedFile $profileImage): string
    {
        $originalName = pathinfo($profileImage->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = $this->slugger->slug($originalName);
        $filename = sprintf(
            'uploads/profiles/%s-%s.%s',
            $safeName,
            uniqid(),
            $profileImage->guessExtension() ?: 'jpg',
        );

        $profileImage->move(
            $this->projectDir.'/public/uploads/profiles',
            basename($filename),
        );

        return $filename;
    }
}
