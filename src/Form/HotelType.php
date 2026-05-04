<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Hotel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @extends AbstractType<\App\Entity\Hotel>
 */
final class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'hotel_page.form.fields.name',
            ])
            ->add('address', TextType::class, [
                'label' => 'hotel_page.form.fields.address',
            ])
            ->add('capacity', IntegerType::class, [
                'label' => 'hotel_page.form.fields.capacity',
                'attr' => ['min' => 0],
            ]);

        if ($options['include_coordinates']) {
            $builder
                ->add('latitude', NumberType::class, [
                    'label' => 'hotel_page.form.fields.latitude',
                    'required' => true,
                    'scale' => 7,
                    'html5' => true,
                    'attr' => [
                        'step' => 'any',
                        'min' => -90,
                        'max' => 90,
                    ],
                ])
                ->add('longitude', NumberType::class, [
                    'label' => 'hotel_page.form.fields.longitude',
                    'required' => true,
                    'scale' => 7,
                    'html5' => true,
                    'attr' => [
                        'step' => 'any',
                        'min' => -180,
                        'max' => 180,
                    ],
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
            'include_coordinates' => true,
        ]);
        $resolver->setAllowedTypes('include_coordinates', 'bool');
    }
}
