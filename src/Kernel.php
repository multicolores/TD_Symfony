<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureRoutes(RoutingConfigurator $routes)
    {
        $extentions = '{php, xml}';

        $routes->import('../config/{routes}' . $this->environment . "/*.$extentions");
        $routes->import("../config/{routes}/*.$extentions");
        $routes->import("../config/{routes}.$extentions");
    }
}
