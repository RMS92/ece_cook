<?php


namespace App\Controller;


use App\Entity\User;
use App\Repository\RecipeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    /**
     * @var RecipeRepository
     */
    private RecipeRepository $recipeRepository;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    public function __construct(UserRepository $userRepository, RecipeRepository $recipeRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->recipeRepository = $recipeRepository;
        $this->em = $em;
    }

    /**
     * @Route("/auteur/{slug}-{id}", name="author.showRecipe")
     * @param User $user
     * @param string $slug
     * @param Request $request
     * @return Response
     */
    public function showRecipe(User $user, string $slug, Request $request): Response
    {
        if ($user->getSlug() !== $slug) {
            return $this->redirectToRoute('author.showRecipe', [
                'id' => $user->getId(),
                'slug' => $user->getSlug(),
            ], 301);
        }

        $recipes = $this->recipeRepository->paginateRecipeForUser($request->query->getInt('page', 1), $user->getId());

        return $this->render('author/showRecipe.html.twig', [
            'current_menu' => 'recipe',
            'user' => $user,
            'recipes' => $recipes
        ]);
    }
}