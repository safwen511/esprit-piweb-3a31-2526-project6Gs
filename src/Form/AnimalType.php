<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Animal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'pet_home.form.name',
                'required' => true,
            ])
            ->add('type', TextType::class, [
                'label' => 'pet_home.form.species',
                'required' => true,
            ])
            ->add('breed', TextType::class, [
                'label' => 'pet_home.form.breed',
                'required' => false,
            ])
            ->add('ageValue', IntegerType::class, [
                'label' => 'pet_home.form.age',
                'mapped' => false,
                'data' => $options['age_value'],
                'constraints' => [
                    new Assert\NotNull(['message' => 'pet_home.validation.age_required']),
                    new Assert\Positive(['message' => 'pet_home.validation.age_positive']),
                    new Assert\LessThanOrEqual(['value' => 300, 'message' => 'pet_home.validation.age_max']),
                ],
            ])
            ->add('ageUnit', ChoiceType::class, [
                'label' => 'pet_home.form.unit',
                'required' => true,
                'mapped' => false,
                'data' => $options['age_unit'],
                'choices' => [
                    'pet_home.form.months' => 'months',
                    'pet_home.form.years' => 'years',
                ],
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'pet_home.form.gender',
                'choices' => [
                    'pet_home.form.male' => 'MALE',
                    'pet_home.form.female' => 'FEMALE',
                ],
                'required' => true,
                'placeholder' => 'pet_home.form.choose_gender',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'pet_home.form.description',
                'required' => false,
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'pet_home.form.status',
                'required' => true,
                'choices' => [
                    'pet_home.status.available' => 'AVAILABLE',
                    'pet_home.status.adopted' => 'ADOPTED',
                ],
            ])
            ->add('image', FileType::class, [
                'label' => 'pet_home.form.image',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new Assert\Optional([
                        new Assert\File([
                            'maxSize' => '5M',
                            'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
                            'mimeTypesMessage' => 'pet_home.validation.image_types',
                        ]),
                    ]),
                ],
                'attr' => ['accept' => 'image/jpeg,image/png,image/gif'],
            ]);

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event): void {
            $animal = $event->getData();
            $form = $event->getForm();

            if (!$animal instanceof Animal) {
                return;
            }

            $ageValue = $form->has('ageValue') ? $form->get('ageValue')->getData() : null;
            $ageUnit = $form->has('ageUnit') ? (string) $form->get('ageUnit')->getData() : 'months';

            if ($ageValue !== null && $ageValue !== '') {
                $animal->setAge($ageUnit === 'years' ? (int) $ageValue * 12 : (int) $ageValue);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
            'age_value' => null,
            'age_unit' => 'months',
        ]);
    }
}
