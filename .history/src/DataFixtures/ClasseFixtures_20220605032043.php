<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $prof = new Professeur();
            $pos=round(0,2);
            $prof->setNomComplet($this->faker->name());
            $prof->setGrade($grade[$pos]);
            $manager->persist($prof);
        }

        $manager->flush();

        $manager->flush();
    }
}
