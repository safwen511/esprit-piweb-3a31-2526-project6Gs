<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @extends AbstractType<\App\Entity\User>
 */
class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'trim' => true,
                'label' => 'profile_page.fields.first_name',
            ])
            ->add('lastName', TextType::class, [
                'trim' => true,
                'label' => 'profile_page.fields.last_name',
            ])
            ->add('email', EmailType::class, [
                'trim' => true,
                'label' => 'profile_page.fields.email',
            ])
            ->add('phoneNumber', TelType::class, [
                'required' => false,
                'trim' => true,
                'label' => 'profile_page.fields.phone',
            ])
            ->add('profileImage', FileType::class, [
                'required' => false,
                'mapped' => false,
                'label' => 'profile_page.fields.profile_photo',
                'help' => 'profile_page.edit.image_help',
                'constraints' => [
                    new Assert\Image(
                        maxSize: '4M',
                        mimeTypesMessage: 'profile_page.validation.image_invalid',
                    ),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
