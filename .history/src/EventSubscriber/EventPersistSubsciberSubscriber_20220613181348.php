<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventPersistSubsciberSubscriber implements EventSubscriberInterface
{
    public function onPrePersist($event): void
    {
        // ...
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'prePersist' => 'onPrePersist',
        ];
    }
}
