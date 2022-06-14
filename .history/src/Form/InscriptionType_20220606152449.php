<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet')
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('matricule')
            ->add('sexe')
            ->add('adresse')
            ->add('classe')
            ->add('etudiant')
            ->add('user');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
            'data_class_et' => Etudiant::class,

        ]);
    }
}
