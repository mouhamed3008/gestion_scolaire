<?php
namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class   UserPasswordEncoderSubscriber implements EventSubscriber{

  
    
    
    public function getSubscribedEvents():array {
        return [
            Events::prePersist,
            Events::preUpdate
            
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->encoder->encodeUserPassword($args); 
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->encoder->encodeUserPassword($args); 
    }


    public function encodeUserPassword(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof User) {
            return;
        }
        dump($entity);
        $entity->setPassword($this->encoder->encodeUserPassword($entity, $entity->getPassword()));
        dd($entity);

    }


    
}