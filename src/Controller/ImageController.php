<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ImageController extends AbstractController
{

    /**
     * @Route("/img/home/", name="img_home")
     */
    public function home(): Response
    {
        // go to  http://127.0.0.1:8000/img/home/
        // #[Route('/img/home/', name: 'img_home')]

        // $titre = "Site image";
        return $this->render('/img/home.html.twig', [
            'title' => 'Site image'
        ]);
    }
}
