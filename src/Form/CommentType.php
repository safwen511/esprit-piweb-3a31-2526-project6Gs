<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Comment;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('body', TextareaType::class, [
            'constraints' => [
                new NotBlank(),
                new Length(max: 5000),
            ],
            'attr' => [
                'rows' => 3,
                'placeholder' => 'feed_page.form.comment_placeholder',
            ],
            'label' => 'feed_page.form.comment',
        ]);

        if ($options['allow_author_selection']) {
            $builder->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => static function (User $user): string {
                    return $user->getName() ?? ($user->getEmail() ?? sprintf('User #%d', $user->getId() ?? 0));
                },
                'placeholder' => 'feed_page.form.choose_comment_author',
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
            'allow_author_selection' => false,
        ]);

        $resolver->setAllowedTypes('allow_author_selection', 'bool');
    }
}
