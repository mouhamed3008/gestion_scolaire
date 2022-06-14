<?php


namespace App\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordEventSubscriber implements EventSubscriber{

    private UserPasswordHasherInterface $encoder;

}