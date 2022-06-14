<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;

class ProfesseurFixtures extends Fixture
{

    private Generator $faker;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->faker = Factory::create("fr_Fr");
    }
    
    public function load(ObjectManager $manager): void
    {
        $prof = new Professeur();
        
        $manager->persist($prof);

        $manager->flush();
    }
}
