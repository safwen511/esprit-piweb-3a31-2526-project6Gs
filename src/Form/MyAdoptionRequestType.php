<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\AdoptionRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class MyAdoptionRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('requestDate', DateTimeType::class, [
                'label' => 'pet_home.form.request_date',
                'required' => true,
                'widget' => 'single_text',
                'html5' => true,
                'constraints' => [
                    new Assert\NotNull(['message' => 'pet_home.validation.request_date_required']),
                    new Assert\LessThanOrEqual(['value' => 'now', 'message' => 'pet_home.validation.request_date_future']),
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'pet_home.actions.update_request',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdoptionRequest::class,
        ]);
    }
}
