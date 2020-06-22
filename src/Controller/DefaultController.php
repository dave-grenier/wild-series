<?php
// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class DefaultController extends AbstractController
{
   /**
     * @Route("/default", name="app_index")
    */
    public function index() :Response
    {
        return $this->render('default/index.html.twig', [
                'bienvenue' => 'Bienvenue !',
        ]);
    }
}    
