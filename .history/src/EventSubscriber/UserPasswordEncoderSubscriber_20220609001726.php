<?php
namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class   UserPasswordEncoderSubscriber implements EventSubscriber{

    private UserPasswordHasherInterface $encoder;

    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder = $encoder;
    }
    
    
    public function getSubscribedEvents():array {
        return [
            Events::prePersist,
            Events::preUpdate
            
        ];
    }

    public function prePersist(User $user):void {}
    {
        $this->encoder->encodeUserPassword($args); 
    }

    public function preUpdate(User $user):void {}
    {
        $this->encoder->encodeUserPassword($args); 
    }


    public function encodeUserPassword(User $user):void {}
    {
        $entity = $args->getObject();

        if ($user->getPlainPassword() === null) {
            return;
        }

        // if (!$entity instanceof User) {
        //     return;
        // }
        dump($entity);
        $entity->setPassword($this->encoder->encodeUserPassword($entity, $entity->getPassword()));
        dd($entity);

    }


    
}