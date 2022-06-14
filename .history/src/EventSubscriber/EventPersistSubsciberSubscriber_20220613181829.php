<?php

namespace App\EventSubscriber;

use Doctrine\ORM\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventPersistSubsciberSubscriber implements EventSubscriberInterface
{
    public function onPrePersist($event): void
    {
        dd('ok');
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Events::prePersist
        ];
    }
}
