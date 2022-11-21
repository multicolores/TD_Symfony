<?php

namespace App;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../config/{packages}/*.yaml');
        $container->import('../config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file(\dirname(__DIR__).'/config/services.yaml')) {
            $container->import('../config/services.yaml');
            $container->import('../config/{services}_'.$this->environment.'.yaml');
        } else {
            $container->import('../config/{services}.php');
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $extensions = "{php,yaml,xml}";
        $routes->import('../config/{routes}/' . $this->environment . "/*.$extensions");
        $routes->import("../config/{routes}/*.$extensions");
        $routes->import("../config/{routes}.$extensions");
    }

    public function boot()
    {
        Parent::boot();
        /** @var EventDispatcher $dispatcher */
        $dispatcher = $this->getContainer()->get('event_dispatcher');
        $dispatcher->addListener(
            'kernel.controller',
            function (ControllerEvent $event){
                var_dump(date("h:i:s"));

                $current_time = date("h:i:s");

                $date1 = DateTime::createFromFormat('h:i:s', $current_time);
                $date2 = DateTime::createFromFormat('h:i:s', "00:48:14");
                $date3 = DateTime::createFromFormat('h:i:s', "04:48:14");
                if ($date1 > $date2 && $date1 < $date3)
                {
                   echo 'here';
                }

                // $controller = $this->getContainer()->get('App\Controller\Client');
                // $event->setController([$controller, 'clients']);
            },
            128
        );


        // Parent::boot();
        // /** @var EventDispatcher $dispatcher */
        // $dispatcher = $this->getContainer()->get('event_dispatcher');
        // $dispatcher->addListener(
        //     'kernel.controller',
        //     function (ControllerEvent $event) {
        //         // $response = new Response();

        //         // $response->setStatusCode(Response::HTTP_FORBIDDEN);


        //         // $response->headers->set('Content-Type', 'text/html');
        //         // $controller = $this->getContainer()->get('App\Controller\Client');
        //         // $event->setController([$controller, 'info'], ['prenom'=>'yes']);

        //         // $request = $this->container->get('request');
        //         // // $routeName = $request->get('_route');

        //         // // $request = $event->getRequest();
        //         // $route = $this->router->getRouteCollection()->get(
        //         //     $request->attributes->get('_route')
        //         // );

        //         // $options = $route->getOptions();

        //         // // $request = $event->getRequest();
        //         // // $route = $this->router->getRouteCollection()->get(
        //         // //     $request->attributes->get('_route')
        //         // // );
        //         // // $options = $route->getOptions();
        //         // // $options = $request->attributes->get('_route');
        //         // // var_dump($request->attributes);

        //         // // $options = $route->getOptions();

        //         $controller = $this->getContainer()->get('App\Controller\Client');
        //         $event->setController([$controller, 'clients']);
        //         $request = $event->getRequest();
        //         // $test = $request->attributes->getRouteCollection()->get($request->attributes->get('_route'));
        //         var_dump($request->getBasePath());
        //     },
        //     128
        // );
    }
}
