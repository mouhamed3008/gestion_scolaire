<?php
namespace App\EventSubscriber;

use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class   UserPasswordEncoderSubscriber implements EventSubscriber{

    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }
    
    
    public function getSubscribedEvents():array {
        return [
            Events::prePersist,
            Events::preUpdate
            
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        
    }

    
}