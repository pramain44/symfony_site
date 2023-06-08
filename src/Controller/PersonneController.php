<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;

class PersonneController extends AbstractController
{
    //*************** faire un READ avec doctrine ****************

    #[Route('/personne', name: 'app_personne')]
    public function index(ManagerRegistry $doctrine): Response
    {   
        // pour faire un select on utilise repository ainsi que l'entité qu'on veut select
        $repository = $doctrine->getRepository(Personne::class);
        // On peut ensuite utiliser les differentes methodes de repository sur l'entité ciblé
        $personnes = $repository->findAll();
        
        return $this->render('personne/index.html.twig', ['personnes' => $personnes]);
    }

    //  ****************  faire un INSERT avec doctrine ****************

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
        return $this->render('/personne/add.html.twig', ['controller_name' => 'PersonneController',]);
    }

    // ****************** read une personne et gestion de l'id *********************
    public function detail(ManagerRegistry $doctrine, $id): Response {

        $repository = $doctrine->getRepository(Personne::class);
        $personne = $repository->find($id);

        if(!$personne){
            $this->addFlash('error','l\'id n\'existe pas');
            return $this->redirectToRoute('personne');
        }
        return $this->render('/personne/detail.html.twig', ['personne' => $personne]);
    }

    public function indexAll(ManagerRegistry $doctrine, $page, $nb): Response {

        $repository = $doctrine->getRepository(Personne::class);
        $nbPersonne = $repository->count([]);
        $nbPage = ceil($nbPersonne / $nb); // nombre d'entrée ds la bdd  (ici des personnes) divisé par la limit


        // findBy permet de search avec 4 parametres (name,id puis ASC/DESC puis limit en enfin offset)
        $personnes = $repository->findBy([],[],$nb,($page - 1) * $nb);

        return $this->render('/personne/index.html.twig',[
            'personnes' => $personnes,
            'nbPage' => $nbPage,
            'page' => $page,
            'nb' => $nb
        ]);
    }
}
