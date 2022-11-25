<?php

namespace App\EventListener;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;


class RequestListener extends AbstractController
{
    // Store the absolute path of the project injected through the service
    private $projectDir;

    /* @var $twig \Twig\Environment */
    private $twig;
    private $router;
    private $request_stack;

    public function __construct(Environment $twigEnvironment, RouterInterface $router, RequestStack $request_stack)
    {
        $this->twig = $twigEnvironment;
        $this->router = $router;
       $this->request_stack = $request_stack;
    }




    public function onKernelController(ControllerEvent $event)
    {

        // var_dump($this->request);

        $route = $this->request_stack->getCurrentRequest()->get('_route_params');

        // var_dump($route);
        if (isset($route["ouverture"])){
            $heure = explode("-", $route['ouverture']);
            // var_dump(date('G'));
            if (!(date('G') > $heure[0]) || !(date('G') < $heure[1])) {

                   $event->stopPropagation();
                   $event->setController(function () {
                       return $this->render('/TD3/not-authorize.html.twig');
                   });
               }
           }
    }

}
