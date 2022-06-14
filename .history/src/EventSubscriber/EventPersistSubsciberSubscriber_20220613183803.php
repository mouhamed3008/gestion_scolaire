<?php

namespace App\EventSubscriber;

use Doctrine\ORM\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventPersistSubsciberSubscriber implements EventSubscriberInterface
{
    

    public static function getSubscribedEvents(): array
    {
        return [
            Events::prePersist
        ];
    }
}
