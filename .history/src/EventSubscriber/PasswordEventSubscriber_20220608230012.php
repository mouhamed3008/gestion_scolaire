<?php
namespace App\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordEventSubscriber implements EventSubscriber{

    private UserPasswordEncoderInterface $encoder;

    function __construct(UserPasswordEncoderInterface $encoder)

}