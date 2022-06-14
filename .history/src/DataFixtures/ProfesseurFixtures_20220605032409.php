<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfesseurFixtures extends Fixture
{

    private Generator $faker;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->faker = Factory::create("fr_Fr");
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $grade=["INGENIEUR","DOCTEUR"];
        for ($i = 0; $i < 10; $i++) {
            $prof = new Professeur();
            $pos=round(0,2);
            $prof->setNomComplet($this->faker->name());
            $prof->setGrade($grade[$pos]);
            $prof->setEtat(1)
            $manager->persist($prof);
        }

        $manager->flush();
    }
}
