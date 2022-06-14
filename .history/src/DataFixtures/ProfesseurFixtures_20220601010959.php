<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfesseurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $prof = new Professeur();
        $manager->persist($product);

        $manager->flush();
    }
}
