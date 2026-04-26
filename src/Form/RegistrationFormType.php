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
                'label' => 'auth.fields.first_name',
                'constraints' => [
                    new Assert\NotBlank(message: 'auth.validation.first_name_required'),
                    new Assert\Length(
                        min: 2,
                        max: 120,
                        minMessage: 'auth.validation.first_name_min',
                        maxMessage: 'auth.validation.first_name_max',
                    ),
                    new Assert\Regex(
                        pattern: "/^[\p{L}\s'-]+$/u",
                        message: 'auth.validation.first_name_format',
                    ),
                ],
            ])
            ->add('lastName', TextType::class, [
                'trim' => true,
                'label' => 'auth.fields.last_name',
                'constraints' => [
                    new Assert\NotBlank(message: 'auth.validation.last_name_required'),
                    new Assert\Length(
                        min: 2,
                        max: 120,
                        minMessage: 'auth.validation.last_name_min',
                        maxMessage: 'auth.validation.last_name_max',
                    ),
                    new Assert\Regex(
                        pattern: "/^[\p{L}\s'-]+$/u",
                        message: 'auth.validation.last_name_format',
                    ),
                ],
            ])
            ->add('email', EmailType::class, [
                'trim' => true,
                'label' => 'auth.fields.email',
                'constraints' => [
                    new Assert\NotBlank(message: 'auth.validation.email_required'),
                    new Assert\Email(message: 'auth.validation.email_invalid'),
                ],
            ])
            ->add('phoneNumber', TelType::class, [
                'required' => false,
                'trim' => true,
                'label' => 'auth.fields.phone',
                'constraints' => [
                    new Assert\Length(max: 30, maxMessage: 'auth.validation.phone_max'),
                    new Assert\Regex(
                        pattern: '/^\+?[0-9\s().-]{7,30}$/',
                        message: 'auth.validation.phone_invalid',
                    ),
                ],
            ])
            ->add('isVeteranApplicant', CheckboxType::class, [
                'required' => false,
                'label' => 'auth.register.veterinary_request',
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'first_options' => ['label' => 'auth.fields.password'],
                'second_options' => ['label' => 'auth.fields.confirm_password'],
                'invalid_message' => 'auth.validation.password_confirm_mismatch',
                'constraints' => [
                    new Assert\NotBlank(message: 'auth.validation.password_required'),
                    new Assert\Length(min: 8, minMessage: 'auth.validation.password_min'),
                    new Assert\Regex(
                        pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                        message: 'auth.validation.password_strength',
                    ),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'auth.register.agree_terms',
                'constraints' => [
                    new Assert\IsTrue(message: 'auth.validation.agree_terms'),
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
