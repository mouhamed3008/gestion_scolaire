<?php

namespace App\Form;

use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfesseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet')
            ->add('grade')
            ->add('etat''number', ['empty_data' => 'Default value')
            ->add('classes')
            ->add('modules')
        ;
    }

    //la classe a laquelle on va recup nos données
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
        ]);
    }
}
