<?php

namespace App\EventSubscriber;

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
            'encodePassword' => 'onEncodePassword',
        ];
    }
}
