<?php

namespace App\Form;

use App\Form\EtudiantType;
use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options, SessionInterface $session): void
    {
        $builder
            ->add('etudiant', EtudiantType::class)
            ->add('classe')
            ->add('anneeScolaire', ChoiceType::class,[
                'attr'=>[
            ->add('classe')
                    'value' => $session->get('annees')
                ]
            ])
            ->add('enregistrer', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
