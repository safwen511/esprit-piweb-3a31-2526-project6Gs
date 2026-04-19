<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\AdoptionRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class AdoptionRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('animalIdDisplay', IntegerType::class, [
                'label' => 'pet_home.form.animal_id',
                'mapped' => false,
                'data' => $options['animal_id'],
                'disabled' => true,
            ])
            ->add('clientIdDisplay', IntegerType::class, [
                'label' => 'pet_home.form.user_id',
                'mapped' => false,
                'data' => $options['client_id'],
                'disabled' => true,
            ])
            ->add('statusDisplay', TextType::class, [
                'label' => 'pet_home.form.status',
                'mapped' => false,
                'data' => $options['status'],
                'disabled' => true,
            ])
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
                'label' => 'pet_home.actions.submit_request',
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
    }
}
