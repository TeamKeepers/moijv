<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    // annotation Symfony via class Route permet de dire à Symfony l'affichage via la home
    /**
     * @Route("/")
     * @Route("/home")
     */
    public function home() 
    {
        return $this->render('home.html.twig');
    }
}
