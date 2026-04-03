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

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'trim' => true,
                'constraints' => [
                    new Assert\NotBlank(message: 'Enter your first name.'),
                    new Assert\Length(
                        min: 2,
                        max: 120,
                        minMessage: 'First name must be at least {{ limit }} characters.',
                        maxMessage: 'First name cannot be longer than {{ limit }} characters.',
                    ),
                    new Assert\Regex(
                        pattern: "/^[\p{L}\s'-]+$/u",
                        message: 'First name can only contain letters, spaces, apostrophes, and hyphens.',
                    ),
                ],
            ])
            ->add('lastName', TextType::class, [
                'trim' => true,
                'constraints' => [
                    new Assert\NotBlank(message: 'Enter your last name.'),
                    new Assert\Length(
                        min: 2,
                        max: 120,
                        minMessage: 'Last name must be at least {{ limit }} characters.',
                        maxMessage: 'Last name cannot be longer than {{ limit }} characters.',
                    ),
                    new Assert\Regex(
                        pattern: "/^[\p{L}\s'-]+$/u",
                        message: 'Last name can only contain letters, spaces, apostrophes, and hyphens.',
                    ),
                ],
            ])
            ->add('email', EmailType::class, [
                'trim' => true,
                'constraints' => [
                    new Assert\NotBlank(message: 'Enter your email address.'),
                    new Assert\Email(message: 'Enter a valid email address.'),
                ],
            ])
            ->add('phoneNumber', TelType::class, [
                'required' => false,
                'trim' => true,
                'constraints' => [
                    new Assert\Length(max: 30, maxMessage: 'Phone number cannot be longer than {{ limit }} characters.'),
                    new Assert\Regex(
                        pattern: '/^\+?[0-9\s().-]{7,30}$/',
                        message: 'Enter a valid phone number.',
                    ),
                ],
            ])
            ->add('profileImage', FileType::class, [
                'required' => false,
                'mapped' => false,
                'label' => 'Profile photo',
                'help' => 'Choose a photo from your computer.',
                'constraints' => [
                    new Assert\Image(
                        maxSize: '4M',
                        mimeTypesMessage: 'Upload a valid image file.',
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
