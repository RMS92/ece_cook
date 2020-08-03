<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @Route("/recettes", name="recipe.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('recipe/index.html.twig', [
            'current_menu' => 'recipe'
        ]);
    }

    /**
     * @Route("/recettes/recette-id", name="recipe.show")
     * @return Response
     */
    public function show(): Response
    {
        return $this->render('recipe/show.html.twig', [
            'current_menu' => 'recipe'
        ]);
    }
}