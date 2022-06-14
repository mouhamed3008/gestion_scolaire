<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;

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