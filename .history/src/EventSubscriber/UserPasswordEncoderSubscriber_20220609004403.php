<?php
namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
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

    public function prePersist(User $user)
    {
        // $this->encoder->encodeUserPassword($args); 
    }

    public function preUpdate(User $user)
    {
        $this->encoder->encodeUserPassword($user); 
    }


    public function encodeUserPassword(User $user)
    {
        // $entity = $args->getObject();

        if ($user->getPassword() === null) {
            return;
        }
        $user->setPassword($this->encoder->hashPassword($user, $user->getPassword()));

        // if (!$entity instanceof User) {
        //     return;
        // }
        // dump($entity);
        // $entity->setPassword($this->encoder->encodeUserPassword($entity, $entity->getPassword()));
        // dd($entity);

    }


    
}