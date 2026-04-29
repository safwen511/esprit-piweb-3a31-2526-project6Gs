<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @extends AbstractType<mixed>
 */
class SmsResetPasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'label' => 'password_reset.sms.code_label',
                'mapped' => false,
                'trim' => true,
                'constraints' => [
                    new Assert\NotBlank(message: 'password_reset.sms.code_required'),
                    new Assert\Length(
                        min: 4,
                        max: 10,
                        minMessage: 'password_reset.sms.code_invalid',
                        maxMessage: 'password_reset.sms.code_invalid',
                    ),
                ],
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
