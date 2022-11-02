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

        $imgName .= ".jpeg";
        if (!file_exists(__DIR__."/../../images/$imgName")){
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
            return $this->file(__DIR__."/../../images/$imgName");
    }

    /**
     * @Route("/img/menu/", name="img_menu")
     */
    public function menu(): Response
    {
        // go to  http://127.0.0.1:8000/img/menu
        
        $imagesFiles = scandir(__DIR__."/../../images/");
        foreach ($imagesFiles as $key => $value) {
            if(is_dir($value) || $value == ".DS_Store" ){
                unset($imagesFiles[$key]);
            }
        }
        // var_dump($imagesFiles);

        return $this->render('/img/menu.html.twig', [
            'imagesFiles' => $imagesFiles
        ]);
    }
}
