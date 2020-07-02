<?php
// src/Controller/WildController.php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;

/**
 * @Route("wild", name="wild_")
 */
Class WildController extends AbstractController
{
    /**
     * Show all rows from Program’s entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index() : Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(program::class)
            ->findall();
        if (!$programs) {
            throw $this->createNotFoundException(
            'no program found in program\'s table.'
            );
        }

        return $this->render(
            'wild/index.html.twig',
            ['programs' => $programs]
        );
    }

   /**
     * @Route("/show/{slug}",
     *  requirements={"slug"="[a-z1-9\-\/]+"},
     *  name="show")
     */
    public function show($slug =""): Response
    {
        $slug = str_replace('-',' ', $slug);
        $slug = ucwords($slug);
        if (empty($slug)){
            $slug = "Aucune série sélectionnée, veuillez choisir une série";
        }

        $program = $this->getDoctrine()
        ->getRepository(Program::class)
        ->findOneBy(['title' => str_replace('-',' ',mb_strtolower($slug)) ]);

        return $this->render(
            'wild/show.html.twig', [
            'slug' => $slug,
            'program'=> $program,
        ]);
    }

    /**
     *
     * @Route("/wild/category/{categoryName}", name="show_category")
     */
    public function showByCategory(string $categoryName)
    {

        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => ucwords($categoryName)]);
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['category' => $category],['id'=>'DESC'],3);

        return $this->render('wild/category.html.twig', [
            'programs' => $programs,


        ]);
    }
}
  