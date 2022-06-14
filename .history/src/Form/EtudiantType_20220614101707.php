<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet')
            ->add('email')
            ->add('sexe', ChoiceType::class, [
                'choices'  => [
                    'Masculin' => 'masculin',
                    'Féminin' => 'féminin',
                ],
            ])
            ->add('adresse')
            ->add('password')
            ->add('matricule')
            ->add('roles', ChoiceType::class,[
                'attr'=>[
                    'value' => 'ROLE_ETUDIANT'
                ]
            ])
            ->add('enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
