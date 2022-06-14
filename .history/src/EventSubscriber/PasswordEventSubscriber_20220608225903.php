<?php
namespace App\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterfac;

class PasswordEventSubscriber implements EventSubscriber{

    private UserPasswordEncoderInterface $encoder;

}