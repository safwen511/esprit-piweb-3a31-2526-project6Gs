<?php

namespace App\Form;

use App\Model\UserSearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @extends AbstractType<\App\Model\UserSearchData>
 */
class UserSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('term', SearchType::class, [
                'required' => false,
                'label' => 'Search',
                'attr' => [
                    'placeholder' => 'Search by first name, last name, or email',
                ],
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Filter',
                'choices' => [
                    'All users' => UserSearchData::STATUS_ALL,
                    'Active only' => UserSearchData::STATUS_ACTIVE,
                    'Inactive only' => UserSearchData::STATUS_INACTIVE,
                    'Verified only' => UserSearchData::STATUS_VERIFIED,
                    'Unverified only' => UserSearchData::STATUS_UNVERIFIED,
                    'Veterinary requests' => UserSearchData::STATUS_VETERAN_PENDING,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserSearchData::class,
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
