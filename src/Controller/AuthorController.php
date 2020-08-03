<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @Route("/auteur-slug", name="author.showRecipe")
     * @return Response
     */
    public function showRecipe(): Response
    {
        return $this->render('author/showRecipe.html.twig');
    }
}