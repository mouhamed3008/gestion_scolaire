<?php
namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;


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

        $encoded = $this->passwordEncoder->encodePassword(
            $entity,
            $entity->getPlainPassword()
        );
        $entity->setPassword($encoded);
        dd($entity);

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