<?php

namespace App\EventSubscriber;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventSubscriber implements EventSubscriberInterface
{
    public function onEncodePassword($event): void
    {
        // ...
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postUpdate
        ];
    }


    public function postPersist(LifecycleEventArgs $args)
    {
        # code...
    }


}
