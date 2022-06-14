<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EtudiantType extends AbstractType
{
    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder = $encoder;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $etudiant = new Etudiant();
        $pass = 'passer';
        $plainPassword = $this->encoder->hashPassword($etudiant, $pass);
        $builder
            ->add('nomComplet')
            ->add('email')
            ->add('email',)
            ->add('password',HiddenType::class,[
                'attr' => [
                    "value"=> $plainPassword
                ]
            ])
            ->add('sexe', ChoiceType::class, [
                'choices'  => [
                    'Masculin' => 'masculin',
                    'Féminin' => 'féminin',
                ],
            ])
            ->add('adresse')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
