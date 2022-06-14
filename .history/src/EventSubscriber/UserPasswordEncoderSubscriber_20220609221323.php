<?php
namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class  UserPasswordEncoderSubscriber{

  private $encoder;
  
    // public function __construct(UserPasswordHasherInterface $encoder)
    // {
    //     $this->encoder = $encoder;
    // }

    // public function prePersist(User $user)
    // {
    //     $this->encodeUserPassword($user); 
    // }

    // public function preUpdate(User $user)
    // {
    //     $this->encodeUserPassword($user); 
    // }


    public function prePersist(LifecycleEventArgs $args=null):void
    {
        $entity = $args->getEntity();

        if (true == property_exists($entity,'password') && ($entity instanceof User or $entity instanceof Etudiant)) {
            $password = 'passer';
            $entity->setPassword($password);
        }
        // $user->setPassword($this->encoder->hashPassword($user, $user->getPassword()));

        // if (!$entity instanceof User) {
        //     return;
        // }
        // dump($entity);
        // $entity->setPassword($this->encoder->encodeUserPassword($entity, $entity->getPassword()));
        // dd($entity);

    }


    
}