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
        return $this->render('recipes/index.html.twig');
    }
}