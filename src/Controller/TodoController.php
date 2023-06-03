<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TodoController extends AbstractController {

    // #[Route('/todoList', name: 'todoList')]

    public function index(Request $request): Response{

        $session = $request->getSession();

        if(!$session->has('todos')){
            $todos = [
                'x' => 'y',
                'a' => 'b',
                'c' => 'd'
            ];
        $session->set('todos', $todos);
        }

        return $this->render('todo/index.html.twig');
    }
}


