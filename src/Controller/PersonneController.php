<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;

class PersonneController extends AbstractController
{
    #[Route('/personne', name: 'app_personne')]
    public function index(): Response
    {
        return $this->render('personne/index.html.twig', [
            'controller_name' => 'PersonneController',
        ]);
    }

    public function addPersonne(ManagerRegistry $doctrine): Response{

        // $this getDoctrine() version 5
        $entityManager = $doctrine->getManager();
        $personne = new Personne;
        $personne->setFirstname('prenom');
        $personne->setName('nom');
        $personne->setAge('27');

        // ajouter l'insertion de la "personne"
        $entityManager->persist($personne); // fonctionne pour l'ajout et la modification

        // execute la transaction
        $entityManager->flush();
        return $this->render('/personne/index.html.twig', ['controller_name' => 'PersonneController',]);
    }
}
