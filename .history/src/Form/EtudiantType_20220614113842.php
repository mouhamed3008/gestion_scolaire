<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EtudiantType extends AbstractType
{
    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder = $encoder;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $pass = 'passer';
        $plainPassword = $encoder->hashPassword();
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
