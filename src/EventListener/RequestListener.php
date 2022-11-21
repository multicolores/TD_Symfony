<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;


class RequestListener
{
    // Store the absolute path of the project injected through the service
    private $projectDir;

    /* @var $twig \Twig\Environment */
    private $twig;

    public function __construct(Environment $twigEnvironment, $projectDir)
    {
        $this->projectDir = $projectDir;
        $this->twig = $twigEnvironment;
    }

    /**
     * Run the verification of the users country on every request.
     * 
     * @param RequestEvent $event
     * @return type
     */
    public function onKernelRequest(RequestEvent $event)
    {
        var_dump("aaa");
        if (!$event->isMasterRequest()) {
            // don't do anything if it's not the master request
        var_dump("oo");
        return;
        }
        $url = $this->router->generate('user_login');
        $response = new RedirectResponse($url);
        $event->setResponse($response);

        // $this->RestrictAccessOnDisallowedCountries($event);
    }

    private function RestrictAccessOnDisallowedCountries(RequestEvent $event)
    {
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $request = $event->getRequest();

        // If the obtained iso code matches with one of the blacklisted countries, block the access
        // rendering a custom page
        $response = new Response();

        // $response->setStatusCode(Response::HTTP_FORBIDDEN);

        // Render some twig view, in our case we will render the blocked.html.twig file
        $response->setContent($this->twig->render("base.html.twig"));

        // // Return an HTML file
        $response->headers->set('Content-Type', 'text/html');
        var_dump("oeoe");
        // // Send response
        $event->setResponse($response);
    }
}
