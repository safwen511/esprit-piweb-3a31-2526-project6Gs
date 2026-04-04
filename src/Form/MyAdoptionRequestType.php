<?php

namespace App\Form;

use App\Entity\AdoptionRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyAdoptionRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('requestDate', DateTimeType::class, [
                'label' => 'form.request.date',
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'actions.update_request',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdoptionRequest::class,
        ]);
    }
}
