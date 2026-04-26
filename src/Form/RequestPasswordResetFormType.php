<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RequestPasswordResetFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('identifier', TextType::class, [
                'label' => 'password_reset.request.identifier_label',
                'trim' => true,
                'constraints' => [
                    new Assert\NotBlank(message: 'password_reset.request.identifier_required'),
                ],
            ])
            ->add('channel', ChoiceType::class, [
                'label' => 'password_reset.request.channel_label',
                'choices' => [
                    'password_reset.request.channel_email' => 'email',
                    'password_reset.request.channel_sms' => 'sms',
                ],
                'expanded' => true,
                'multiple' => false,
                'data' => 'email',
                'constraints' => [
                    new Assert\NotBlank(message: 'password_reset.request.channel_invalid'),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
