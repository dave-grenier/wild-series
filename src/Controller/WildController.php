<?php
// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class WildController extends AbstractController
{
   /**
     * @Route("/wild", name="wild_index")
    */
    public function index() :Response
    {
        return $this->render('wild/index.html.twig', [
                'website' => 'Wild Séries',
        ]);
    }

   /**
     * @Route("/wild/show/{slug<^[a-z-]+>}",  name="wild_show")
     */
    public function show($slug =""): Response
    {

        $slug = str_replace('-',' ', $slug);
        $slug = ucwords($slug);
        if (empty($slug)){
            $slug = "Aucune série sélectionnée, veuillez choisir une série";
        }

        return $this->render(
            'wild/show.html.twig', [
            'slug' => $slug,
        ]);
    }
}
  