<?php

namespace App\EventSubscriber;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\HttpKernel\Event\RequestEvent;
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
            RequestEvent::class => 'onKernelRequest'

        ];
    }


    public function onKernelRequest()
    {
        dd('ok');
    }


}
