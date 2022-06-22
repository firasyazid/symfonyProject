<?php

namespace App\Form;

use App\Entity\TabCoach;
use App\Entity\TabSeance;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TabSeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeSeance')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('idCoach',EntityType::class,['class' => TabCoach::class,'choice_label'=>'nomCoach','label'=>'idCoach'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TabSeance::class,
        ]);
    }
}
