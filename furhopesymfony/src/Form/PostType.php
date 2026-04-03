<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;

final class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('caption', TextareaType::class, [
                'required' => false,
                'constraints' => [
                    new Length(max: 10000),
                ],
                'attr' => [
                    'rows' => 4,
                    'placeholder' => 'Share a rescue update, adoption story, or a pet moment...',
                ],
                'label' => 'Caption',
            ])
            ->add('mediaType', ChoiceType::class, [
                'choices' => [
                    'None' => 'NONE',
                    'Image' => 'IMAGE',
                    'Video' => 'VIDEO',
                ],
                'label' => 'Media type',
            ])
            ->add('mediaPath', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length(max: 500),
                ],
                'label' => 'Media URL or local path',
                'attr' => [
                    'placeholder' => 'https://example.com/cute-pet-photo.jpg or C:\\Users\\you\\Pictures\\pet.jpg',
                ],
            ])
            ->add('mediaFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Upload local media',
                'constraints' => [
                    new File(
                        maxSize: '15M',
                        mimeTypes: [
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                            'image/gif',
                            'video/mp4',
                            'video/webm',
                            'video/ogg',
                        ],
                        mimeTypesMessage: 'Upload an image or video file supported by the feed.',
                    ),
                ],
                'attr' => [
                    'accept' => 'image/*,video/mp4,video/webm,video/ogg',
                ],
            ])
            ->add('visibility', ChoiceType::class, [
                'choices' => [
                    'Public' => 'PUBLIC',
                    'Friends' => 'FRIENDS',
                    'Private' => 'PRIVATE',
                ],
                'label' => 'Who can see this?',
            ]);

        if ($options['allow_author_selection']) {
            $builder->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => static function (User $user): string {
                    return $user->getName() ?? ($user->getEmail() ?? sprintf('User #%d', $user->getId() ?? 0));
                },
                'placeholder' => 'Choose an author',
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
            'allow_author_selection' => false,
        ]);

        $resolver->setAllowedTypes('allow_author_selection', 'bool');
    }
}
