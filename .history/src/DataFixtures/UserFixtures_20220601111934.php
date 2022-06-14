<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private Generator $faker;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->faker = Factory::create("fr_Fr");
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $plainPassword = 'passer';
        for ($i = 1; $i <=10; $i++) {
        $user = new User();
        $pos= rand(0,2);
        $user->setNomComplet($this->faker->name());
        $user->setEmail($this->faker->email());
        $encoded = $this->encoder->hashPassword($user,
        $plainPassword);
        $user->setPassword($encoded);
        $user->setRoles([$roles[$pos]]);
        $manager->persist($user);

    }
        $manager->flush();
    }

}
