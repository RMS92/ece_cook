<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/catégorie/catégorie-slug", name="category.show")
     * @return Response
     */
    public function show(): Response
    {
        return $this->render('category/show.html.twig');
    }
}