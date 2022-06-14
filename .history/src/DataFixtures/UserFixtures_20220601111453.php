<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $roles=["ROLE_USER","ROLE_RP","ROLE_AC"];
        $plainPassword = 'passer@123';
        for ($i = 1; $i <=10; $i++) {
        $user = new User();
        $pos= rand(0,2);
        $user->setNomComplet('Nom et Prenom
'.$i);
$user->setEmail(strtolower($roles[$pos])."@gmail.com".$i);
$encoded = $this->encoder->hashPassword($user,
$plainPassword);
$user->setPassword($encoded);
$user->setRoles([$roles[$pos]]);
$manager->persist($user);


        $manager->flush();
    }
}
