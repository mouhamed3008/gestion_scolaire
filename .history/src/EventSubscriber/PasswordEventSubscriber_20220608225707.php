<?php


namespace App\EventSubscriber;

use Doctrine\Common\EventSubscriber;

class PasswordEventSubscriber implements EventSubscriber{

    private UserPasswordHasherInterface $encoder;

}