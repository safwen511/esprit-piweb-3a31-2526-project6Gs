<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
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
            ->add('isVeteranApplicant', CheckboxType::class, [
                'required' => false,
                'label' => 'I am a veterinaire and want my account reviewed for veterinaire access.',
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm password'],
                'invalid_message' => 'The password confirmation does not match.',
                'constraints' => [
                    new Assert\NotBlank(message: 'Enter a password.'),
                    new Assert\Length(min: 8, minMessage: 'Use at least {{ limit }} characters for the password.'),
                    new Assert\Regex(
                        pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                        message: 'Password must include at least one uppercase letter, one lowercase letter, and one number.',
                    ),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new Assert\IsTrue(message: 'You must agree to the shelter platform terms.'),
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
