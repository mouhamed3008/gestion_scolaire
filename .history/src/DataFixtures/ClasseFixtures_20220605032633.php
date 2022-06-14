<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Classe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClasseFixtures extends Fixture
{

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create("fr_Fr");

    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $classe = new Classe();

            $classe->setLibelle("classe".$i);
            $classe->setFiliere('Genie Logiciel');
            $classe->setNiveau('Licence 1')

        }

        $manager->flush();

    }
}
