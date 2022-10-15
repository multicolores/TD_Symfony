<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class Client
{
    public function info(string $prenom): Response
    {
        // go to  http://127.0.0.1:8000/client/prenom/Bob-Mark-Toto
        
        $refarray = array(
            "Bob" => "Dupond",
            "Mark" => "Lepetit",
            "Toto" => "Duplateau",
            "Luck" => "Legrand",
        );
        $stringOfnames = "";
        $prenom = explode("-", $prenom);
        foreach ($refarray as $corresponding_prenom => $corresponding_nom) {
            foreach ($prenom as $key => $value) {
                if($corresponding_prenom == $value) {
                    $stringOfnames .= " ";
                    $stringOfnames .= $corresponding_nom;
                }
            }

    }
        

        if($stringOfnames)
            return new Response($stringOfnames);
        else
            return new Response("Aucun nom correspondent");
    }
}






// namespace App\Controller;

// use Symfony\Component\HttpFoundation\Response;

// class Client
// {
//     public function info(string $name): Response
//     {
//         $number = random_int(0, 100);

//         return new Response(
//             '<html><body>Lucky number: '.$name.'</body></html>'
//         );
//     }
// }







// class Client
// {
//     public function info(string $nom): Response
//     {
//         $number = random_int(0, 100);
//         $array = array(
//             "Bob" => "tata",
//             "Mark" => "tata",
//             "Bertrand" => "toto",
//             "Luck" => "toto",
//         );

//         // $arrayOfCorrespondingName = array();
//         $stringOfnames = "";
//         foreach ($array as $prenom => $corresponding_name) {
//                 if($corresponding_name == $nom) {
//                     $stringOfnames .= " ";
//                     $stringOfnames .= $prenom;
//                 }
//                 // $arrayOfCorrespondingName = array_push($arrayOfCorrespondingName, $corresponding_name);
//         }

//         if($stringOfnames)
//             return new JsonResponse($stringOfnames);
//         else
//             return new Response("Aucun nom correspondent");
//     }
// }