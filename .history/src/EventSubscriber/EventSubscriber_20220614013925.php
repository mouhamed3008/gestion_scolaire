<?php

namespace App\EventSubscriber;

use Doctrine\ORM\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class EventSubscriber implements EventSubscriberInterface
{
    public function onEncodePassword($event): void
    {
        // ...
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onKernelRequest'

        ];
    }


    public function postPersist(LifecycleEventArgs $args)
    {
        dd($args);
    }


}
