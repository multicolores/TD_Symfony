<?php

namespace App;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Component\Routing\Router;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../config/{packages}/*.yaml');
        $container->import('../config/{packages}/' . $this->environment . '/*.yaml');

        if (is_file(\dirname(__DIR__) . '/config/services.yaml')) {
            $container->import('../config/services.yaml');
            $container->import('../config/{services}_' . $this->environment . '.yaml');
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

    // public function boot()
    // {
    //     Parent::boot();
    //     /** @var EventDispatcher $dispatcher */
    //     $dispatcher = $this->getContainer()->get('event_dispatcher');
    //     $dispatcher->addListener(
    //         'kernel.controller',
    //         function (ControllerEvent $event) {

    //             // $response = new Response();

    //             // $response->setStatusCode(Response::HTTP_FORBIDDEN);


    //             // $response->headers->set('Content-Type', 'text/html');
    //             // $controller = $this->getContainer()->get('App\Controller\Client');
    //             // $event->setController([$controller, 'info'], ['prenom'=>'yes']);

    //             // $request = $this->container->get('request');
    //             // // $routeName = $request->get('_route');


    //             $request = $event->getRequest();
    //             // var_dump($request->get('_route'));
    //             // var_dump($request->attributes->get('_route_params'));
    //             // var_dump($request->attributes->all());

    //             $value = "6-17";
    //             $valuesArray = explode("-", $value);
    //             $valuesArray[0] .= ":00:00";
    //             $valuesArray[1] .= ":00:00";

    //             $current_time = date("H:i:s");
    //             $current_time = DateTime::createFromFormat('H:i:s', $current_time);
    //             $startDate = DateTime::createFromFormat('H:i:s', $valuesArray[0]);
    //             $endDate = DateTime::createFromFormat('H:i:s', $valuesArray[1]);

    //             if ($current_time > $startDate && $current_time < $endDate) {
    //                 var_dump("Authorisé");
    //             } else {
    //                 var_dump("Le site est fermé");
    //             }
                
    //             // $route = $this->container->get('router')->getRouteCollection()->get(
    //             //     $request->attributes->get('_route')
    //             // );
    //             // var_dump($route);

    //             // $options = $route->getOptions();
    //             // var_dump($options['response_type']);
    //             // var_dump($options);

    //             // // $request = $event->getRequest();
    //             // // $route = $this->router->getRouteCollection()->get(
    //             // //     $request->attributes->get('_route')
    //             // // );
    //             // // $options = $route->getOptions();
    //             // // $options = $request->attributes->get('_route');
    //             // // var_dump($request->attributes);

    //             // // $options = $route->getOptions();



    //             // $controller = $this->getContainer()->get('App\Controller\Client');
    //             // $event->setController([$controller, 'clients']);
    //         },
    //         128
    //     );


    //     // Parent::boot();
    //     // /** @var EventDispatcher $dispatcher */
    //     // $dispatcher = $this->getContainer()->get('event_dispatcher');
    //     // $dispatcher->addListener(
    //     //     'kernel.controller',
    //     //     function (ControllerEvent $event) {
    //     //         // $response = new Response();

    //     //         // $response->setStatusCode(Response::HTTP_FORBIDDEN);


    //     //         // $response->headers->set('Content-Type', 'text/html');
    //     //         // $controller = $this->getContainer()->get('App\Controller\Client');
    //     //         // $event->setController([$controller, 'info'], ['prenom'=>'yes']);

    //     //         // $request = $this->container->get('request');
    //     //         // // $routeName = $request->get('_route');

    //     //         // // $request = $event->getRequest();
    //     //         // $route = $this->router->getRouteCollection()->get(
    //     //         //     $request->attributes->get('_route')
    //     //         // );

    //     //         // $options = $route->getOptions();

    //     //         // // $request = $event->getRequest();
    //     //         // // $route = $this->router->getRouteCollection()->get(
    //     //         // //     $request->attributes->get('_route')
    //     //         // // );
    //     //         // // $options = $route->getOptions();
    //     //         // // $options = $request->attributes->get('_route');
    //     //         // // var_dump($request->attributes);

    //     //         // // $options = $route->getOptions();

    //     //         $controller = $this->getContainer()->get('App\Controller\Client');
    //     //         $event->setController([$controller, 'clients']);
    //     //         $request = $event->getRequest();
    //     //         // $test = $request->attributes->getRouteCollection()->get($request->attributes->get('_route'));
    //     //         var_dump($request->getBasePath());
    //     //     },
    //     //     128
    //     // );
    // }
}
