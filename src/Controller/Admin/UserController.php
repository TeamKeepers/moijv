<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("admin/user", name="list_user")
     */
    public function getList(UserRepository $userRepo) // équivaut à faire un $userRepo (objet, instanciation de la class) = new UserRepository
    {
        // notre repository est 'injecté' en paramètre de l'action (la méthode) de notre controlleur. $userRepo contient donc une instance (un objet) prêt à l'emploi de class UserRepository. Cet objet nous sert à récupérer notre liste d'utilisateur
        $users = $userRepo->findAll();
        
        return $this->render('admin/list_user.html.twig', [
            'users' => $users
        ]);
        
    }
    
    /**
     * @Route("/admin/user/{id}", name="user_details")
     */
    public function details(User $user) {
        return $this->render('admin/details_user.html.twig', [
            'user' => $user
        ]);
    }
    // NE PAS OUBLIER DE METTRE EN USE LE CHEMIN VERS ENTITY
//  function ci-dessus équivaut à l'écriture suivante sous symfony précédent au 4 :
//    public function details(UserRepository $userRepo, $id) {
//        $user = $userRepo->find($id);
//        
//    return $this->render('admin/details_user.html.twig', [
//        'user' => $user
//    ]);
//    
//    }
    
}
