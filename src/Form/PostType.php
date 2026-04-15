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
                    'placeholder' => 'feed_page.form.caption_placeholder',
                ],
                'label' => 'feed_page.form.caption',
            ])
            ->add('mediaType', ChoiceType::class, [
                'choices' => [
                    'feed_page.form.none' => 'NONE',
                    'feed_page.form.image' => 'IMAGE',
                    'feed_page.form.video' => 'VIDEO',
                ],
                'label' => 'feed_page.form.media_type',
            ])
            ->add('mediaPath', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length(max: 500),
                ],
                'label' => 'feed_page.form.media_path',
                'attr' => [
                    'placeholder' => 'feed_page.form.media_path_placeholder',
                ],
            ])
            ->add('mediaFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'feed_page.form.media_file',
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
                        mimeTypesMessage: 'feed_page.validation.media_invalid',
                    ),
                ],
                'attr' => [
                    'accept' => 'image/*,video/mp4,video/webm,video/ogg',
                ],
            ])
            ->add('visibility', ChoiceType::class, [
                'choices' => [
                    'feed_page.visibility.public' => 'PUBLIC',
                    'feed_page.visibility.friends' => 'FRIENDS',
                    'feed_page.visibility.private' => 'PRIVATE',
                ],
                'label' => 'feed_page.form.visibility',
            ]);

        if ($options['allow_author_selection']) {
            $builder->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => static function (User $user): string {
                    return $user->getName() ?? ($user->getEmail() ?? sprintf('User #%d', $user->getId() ?? 0));
                },
                'placeholder' => 'feed_page.form.choose_author',
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
