<?php

namespace App\EventSubscriber;

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


    public function onKernelRequest(RequestEvent $event)
    {
        dd($event->getRequest()->request->get('password'));
        if ($event->getRequest()->request->get('password')) {
            dd('ok');
        }

    }


}
