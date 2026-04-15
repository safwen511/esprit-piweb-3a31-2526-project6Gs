<?php
// src/Form/RendezvousType.php
namespace App\Form;

use App\Entity\Animal;
use App\Entity\Disponibilite;
use App\Entity\Rendezvous;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendezvousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $vet    = $options['vet'];
        $client = $options['client'];

        $builder
            ->add('appointmentDate', DateType::class, [
                'label'  => 'Date du rendez-vous',
                'widget' => 'single_text',
            ])
            ->add('appointmentTime', TimeType::class, [
                'label'  => 'Heure',
                'widget' => 'single_text',
            ])
            ->add('disponibilite', EntityType::class, [
                'class'         => Disponibilite::class,
                'label'         => 'Créneau disponible',
                'choice_label'  => fn($d) => $d->getStartTime()->format('H:i') . ' - ' . $d->getEndTime()->format('H:i'),
                'query_builder' => fn(EntityRepository $er) => $er->createQueryBuilder('d')
                    ->where('d.vet = :vet')
                    ->andWhere('d.isAvailable = true')
                    ->setParameter('vet', $vet),
            ])
            ->add('animal', EntityType::class, [
                'class'         => Animal::class,
                'label'         => 'Votre animal',
                'choice_label'  => 'name',
                'query_builder' => fn(EntityRepository $er) => $er->createQueryBuilder('a')
                    ->where('a.ownerCompte = :client')
                    ->setParameter('client', $client),
            ])
            ->add('description', TextareaType::class, [
                'label'    => 'Motif de consultation',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Rendezvous::class]);
        $resolver->setRequired(['vet', 'client']);
    }
}