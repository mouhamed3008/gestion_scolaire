<?php
namespace App\EventSubscriber;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class  UserPasswordEncoderSubscriber implements UserPasswordHasherInterface{


    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder = $encoder;
    }
    
  

    public function prePersist(User $user)
    {
        $this->encodeUserPassword($user); 
    }

    public function preUpdate(User $user)
    {
        $this->encodeUserPassword($user); 
    }


    public function encodeUserPassword(User $user)
    {
        if ($user->getPassword() === null) {
            return;
        }
        $user->setPassword($this->encoder->hashPassword($user, $user->getPassword()));
    }


    
}