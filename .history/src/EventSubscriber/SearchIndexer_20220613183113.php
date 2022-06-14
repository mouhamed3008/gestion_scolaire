<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use App\Entity\Product;

class SearchIndexer
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // only act on some "Product" entity
        if (!$entity instanceof Product) {
            return;
        }

        $entityManager = $args->getObjectManager();
        // ... do something with the Product
    }
}