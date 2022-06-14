<?php
namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;

class   UserPasswordEncoderSubscriber implements EventSubscriber{

  
    private $passwordEncoder;
    public function __construct(UserPasswordEncoder $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    
    public function getSubscribedEvents():array {
        return ['prePersist', 'preUpdate'];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        // $this->encoder->encodeUserPassword($args); 
        $entity = $args->getEntity();
        if (!$entity instanceof User) {
            return;
        }
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