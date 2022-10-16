<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ImageController extends AbstractController
{

    /**
     * @Route("/img/home/{imgName}", name="img_home")
     */
    public function home(string $imgName): Response
    {
        $errorUnknowImg = false;
        //  http://127.0.0.1:8000/img/home/chat
        //  http://127.0.0.1:8000/img/home/chien
        if (!file_exists(__DIR__."/../../images/$imgName.jpeg")){
            $errorUnknowImg = true;
        }
        return $this->render('/img/home.html.twig', [
            'title' => 'Site image',
            'imgName' => $imgName,
            'error' => $errorUnknowImg
        ]);
    }

    /**
     * @Route("/img/data/{imgName}", name="img_affiche")
     */
    public function affiche(string $imgName): Response
    {
            return $this->file(__DIR__."/../../images/$imgName.jpeg");
    }

    /**
     * @Route("/img/menu/", name="img_menu")
     */
    public function menu(): Response
    {
        // go to  http://127.0.0.1:8000/img/menu
        //ici peut etre pas garder la possibiliter que se sois une route ( je pense bien ouais )

        return $this->render('/img/menu.html.twig', [
            'title' => 'Site image'
        ]);
    }
}
