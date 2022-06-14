<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class SearchIndexer
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // only act on some "Product" entity
        if (!$entity instanceof User) {
            return;
        }

        $entityManager = $args->getObjectManager();
        // ... do something with the Product
    }
}