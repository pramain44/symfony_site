<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TodoController extends AbstractController {

    // #[Route('/todoList', name: 'todoList')]

    public function index(Request $request): Response{

        $session = $request->getSession();
        // afficher le tableau de todo
        // Sinon je l'initialise puis l'affiche
        if(!$session->has('todos')){
            $todos = [
                'x' => 'y',
                'a' => 'b',
                'c' => 'd'
            ];
        $session->set('todos', $todos);
        $this->addFlash('info', 'la liste des todos a été créees');
        }

        return $this->render('todo/index.html.twig');
    }

    // fonction pour rajouter un todo (via le get ds cet exemple)
    public function addtodo(Request $request, $name, $content){
        $session = $request->getSession();
        if($session->has('todos')){
            // Vérifier si on deja un todo avec le même name
            $todos = $session->get('todos');
            //on test si le tableau a deja une variable avec cette clé
            if(isset($todos[$name])){
            $this->addFlash('error', 'le todo existe déjà');
            }else{
                // si la variable avec la clé n'existe pas on peut la créee
                $todos[$name] = $content;
                $session->set('todos',$todos);
                $this->addFlash('succes', 'le todo a été ajouté');
            }
        }else{
        // Si non afficher une erreur et redirigé vers l'index
        $this->addFlash('error', 'la liste des todos n\'a pas été créees');

        }
        return $this->redirectToRoute('todoList');
    }

    public function update(Request $request, $name, $content){
        $session = $request->getSession();
        if($session->has('todos')){
            // Vérifier si on deja un todo avec le même name
            $todos = $session->get('todos');
            //on test si le tableau a deja une variable avec cette clé
            if(!isset($todos[$name])){
            $this->addFlash('error', 'le todo existe pas');
            }else{
                // si la variable avec la clé n'existe pas on peut la créee
                $todos[$name] = $content;
                $session->set('todos',$todos);
                $this->addFlash('succes', 'le todo a été modifié');
            }
        }else{
        // Si non afficher une erreur et redirigé vers l'index
        $this->addFlash('error', 'la liste des todos n\'a pas été créees');

        }
        return $this->redirectToRoute('todoList');
    }

    public function delete(Request $request, $name){
        $session = $request->getSession();
        if($session->has('todos')){
            // Vérifier si on deja un todo avec le même name
            $todos = $session->get('todos');
            //on test si le tableau a deja une variable avec cette clé
            if(!isset($todos[$name])){
            $this->addFlash('error', 'le todo existe pas');
            }else{
                // si la variable avec la clé n'existe pas on peut la créee
                unset($todos[$name]) ;
                $session->set('todos',$todos);
                $this->addFlash('succes', 'le todo a été supprimé');
            }
        }else{
        // Si non afficher une erreur et redirigé vers l'index
        $this->addFlash('error', 'la liste des todos n\'a pas été créees');

        }
        return $this->redirectToRoute('todoList');
    }

    public function reset(Request $request){
        $session = $request->getSession();
        $sessions->remove('todos');
        return $this->redirectToRoute('todoList');
    }
}


