<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class testController extends AbstractController {

    // #[Route('/' ,'home.index', methods :[GET])]
    public function index():Response{

        // on retrouve les parametres  dela route dans les attributs de la $request

        // $request = Request::createFromGlobals();

        // $age = $request->query->get('age', 0);

        //$age = $request->attributes->get('age, 0');
        //$age = 'pd';

        //return new Response ("vous avez $age");

            return $this->render('test/index.html.twig');
   
    }

    public function yolo(Request $request, $age):Response{
       
        // $age = $request->attributes->get('age',0);

        return new Response ("2eme page UwU $age");
    }
}

