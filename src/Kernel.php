<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function boot(){
        Parent::boot();
        /** @var EventDispatcher $dispatcher */
        $dispatcher = $this->getContainer()->get('event_dispatcher');
        $dispatcher->addListener(
            'kernel.controller',
            function (ControllerEvent $event){
                $controller = $this->getContainer()->get('App\Controller\Client');
                $event->setController([$controller, 'clients']);
            },
            128
        );
    }
}
