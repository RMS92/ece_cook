<?php


namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @var RecipeRepository
     */
    private RecipeRepository $repository;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    public function __construct(RecipeRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/recettes", name="recipe.index")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $recipes = $this->repository->paginateAllVisible($request->query->getInt('page', 1));

        return $this->render('recipe/index.html.twig', [
            'current_menu' => 'recipe',
            'recipes' => $recipes
        ]);
    }

    /**
     * @Route("/recettes/{slug}-{id}", name="recipe.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Recipe $recipe
     * @param string $slug
     * @param Request $request
     * @return Response
     */
    public function show(Recipe $recipe, string $slug, Request $request): Response
    {
        if ($recipe->getSlug() !== $slug) {
            return $this->redirectToRoute('event.show', [
                'id' => $recipe->getId(),
                'slug' => $recipe->getSlug(),
            ], 301);
        }

        return $this->render('recipe/show.html.twig', [
            'current_menu' => 'recipe',
            'recipe' => $recipe
        ]);
    }
}