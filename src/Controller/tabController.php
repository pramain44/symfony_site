<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class tabController extends AbstractController {

    public function index($nb): Response {

        $notes = [];
        for ($i = 0; $i<$nb; $i++){
            $notes = rand(0,20);
        }

        return $this->render('tab/index.html.twig', [
            'notes' => $notes,
        ]);
    }

    public function users(): Response {

        $users = [
            ['age' => 22, 'firstname' => 'x','name' => 'y'],
            ['age' => 21, 'firstname' => 'c','name' => 'd'],
            ['age' => 20, 'firstname' => 'e','name' => 'f'],
        ];

        return $this->render('tab/users.html.twig', ['users' => $users]);
    }

}