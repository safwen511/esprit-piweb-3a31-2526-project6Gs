<?php

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
                'label' => 'form.animal.name',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Name should not be empty.']),
                    new Assert\Length(['max' => 100, 'maxMessage' => 'Name cannot exceed {{ limit }} characters.']),
                ],
                'attr' => ['required' => true, 'maxlength' => 100],
            ])
            ->add('type', TextType::class, [
                'label' => 'form.animal.species',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Species should not be empty.']),
                    new Assert\Length(['max' => 50, 'maxMessage' => 'Species cannot exceed {{ limit }} characters.']),
                ],
                'attr' => ['required' => true, 'maxlength' => 50],
            ])
            ->add('breed', TextType::class, [
                'label' => 'form.animal.breed',
                'required' => false,
            ])
            ->add('ageValue', IntegerType::class, [
                'label' => 'form.animal.age',
                'mapped' => false,
                'data' => $options['age_value'],
                'constraints' => [
                    new Assert\NotNull(['message' => 'Age should not be blank.']),
                    new Assert\Positive(['message' => 'Age must be a positive number.']),
                    new Assert\LessThanOrEqual(['value' => 300, 'message' => 'Age cannot exceed 300 months.']),
                ],
                'attr' => ['required' => true, 'min' => 1],
            ])
            ->add('ageUnit', ChoiceType::class, [
                'label' => 'form.animal.unit',
                'mapped' => false,
                'data' => $options['age_unit'],
                'choices' => [
                    'form.months' => 'months',
                    'form.years' => 'years',
                ],
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'form.animal.gender',
                'choices' => [
                    'form.gender.male' => 'MALE',
                    'form.gender.female' => 'FEMALE',
                ],
                'required' => false,
                'placeholder' => 'form.animal.choose_gender',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'form.animal.description',
                'required' => false,
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'form.animal.status',
                'choices' => [
                    'status.available' => 'AVAILABLE',
                    'status.adopted' => 'ADOPTED',
                    'status.unavailable' => 'UNAVAILABLE',
                ],
            ])
            ->add('image', FileType::class, [
                'label' => 'form.animal.image',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new Assert\Optional([
                        new Assert\File([
                            'maxSize' => '5M',
                            'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
                            'mimeTypesMessage' => 'Only JPG, PNG, and GIF files are allowed.',
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

        $resolver->setAllowedTypes('age_value', ['null', 'int']);
        $resolver->setAllowedTypes('age_unit', 'string');
    }
}
