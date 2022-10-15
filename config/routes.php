<?php

use App\Controller\Client;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('api_client', '/client/prenom/{prenom}')
        ->controller([Client::class, 'info'])
        ->methods(['GET', 'HEAD'])
        ->requirements(['prenom' => '([a-zA-Z]+)(-[a-zA-Z]+)*']);
};
