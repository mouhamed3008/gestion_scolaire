<?php


namespace App\EventListener;

use App\Entity\User;
use App\Entity\Product;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

class SearchIndexerSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::postUpdate,
        ];c
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        dd('ok');
        $this->index($args);
    }

    public function index(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // perhaps you only want to act on some "Product" entity
        if ($entity instanceof User) {
            $entityManager = $args->getObjectManager();
            // ... do something with the Product
        }
    }
}