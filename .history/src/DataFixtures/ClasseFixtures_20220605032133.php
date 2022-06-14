<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClasseFixtures extends Fixture
{

    private Generator $faker;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->faker = Factory::create("fr_Fr");
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $prof = new Classe();
            $pos=round(0,2);
            $prof->setLibelle($this->faker->name());
        }

        $manager->flush();

    }
}
