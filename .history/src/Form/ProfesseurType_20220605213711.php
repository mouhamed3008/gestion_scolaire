<?php

namespace App\Form;

use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProfesseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet')
            ->add('grade', ChoiceType::class,[
                'choices'  => [
                    'Ingénieur' => 'ingénieur',
                    'Docteur' => 'docteur',
                    'No' => false,
                ],
            ])
            ->add('classes')
            ->add('modules')
            ->add('enregistrer', SubmitType::class)
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
