<?php
namespace App\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class   UserPasswordEncoderSubscriber implements EventSubscriber{

    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }
public function getSubscribedEvents() {}

    
}