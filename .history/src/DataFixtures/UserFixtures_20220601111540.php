<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

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
        $roles=["ROLE_USER","ROLE_RP","ROLE_AC"];
        $plainPassword = 'passer@123';
        for ($i = 1; $i <=10; $i++) {
        $user = new User();
        $pos= rand(0,2);
        $user->setNomComplet();
        $user->setEmail(strtolower($roles[$pos])."@gmail.com".$i);
        $encoded = $this->encoder->hashPassword($user,
        $plainPassword);
        $user->setPassword($encoded);
        $user->setRoles([$roles[$pos]]);
        $manager->persist($user);


        $manager->flush();
    }
}

}
