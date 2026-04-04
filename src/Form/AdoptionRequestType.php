<?php

namespace App\Form;

use App\Entity\AdoptionRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdoptionRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('animalIdDisplay', IntegerType::class, [
                'label' => 'form.request.animal_id',
                'mapped' => false,
                'data' => $options['animal_id'],
                'disabled' => true,
            ])
            ->add('clientIdDisplay', IntegerType::class, [
                'label' => 'form.request.user_id',
                'mapped' => false,
                'data' => $options['client_id'],
                'disabled' => true,
            ])
            ->add('statusDisplay', TextType::class, [
                'label' => 'form.request.status',
                'mapped' => false,
                'data' => $options['status'],
                'disabled' => true,
            ])
            ->add('requestDate', DateTimeType::class, [
                'label' => 'form.request.date',
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'actions.submit_request',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdoptionRequest::class,
            'animal_id' => null,
            'client_id' => null,
            'status' => 'PENDING',
        ]);

        $resolver->setAllowedTypes('animal_id', ['null', 'int']);
        $resolver->setAllowedTypes('client_id', ['null', 'int']);
        $resolver->setAllowedTypes('status', 'string');
    }
}
