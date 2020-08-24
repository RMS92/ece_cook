<?php


namespace App\Controller\Admin;


use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminRecipeController
 * @package App\Controller\Admin
 * @Route("/front_5694/admin/recettes")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminRecipeController extends AbstractController
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
     * @Route("/", name="admin.recipe.index")
     * @return Response
     */
    public function index(): Response
    {
        $recipes = $this->repository->findAll();

        return $this->render('admin/recipe/index.html.twig', [
            'current_menu' => 'admin',
            'recipes' => $recipes
        ]);
    }

    /**
     * @Route("/créer", name="admin.recipe.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($recipe);
            $this->em->flush();
            $this->addFlash('success', "La recette a été correctement créée.");
            return $this->redirectToRoute('admin.recipe.index');
        }

        return $this->render('admin/recipe/new.html.twig', [
            'current_menu' => 'admin',
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.recipe.edit", methods="GET|POST")
     * @param Recipe $recipe
     * @param Request $request
     * @return Response
     */
    public function edit(Recipe $recipe, Request $request): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $recipe->setUpdatedAt(new \DateTime());

            $this->em->persist($recipe);
            $this->em->flush();
            $this->addFlash('success', "La recette a été correctement modifiée.");
            return $this->redirectToRoute('admin.recipe.index');
        }

        return $this->render('admin/recipe/edit.html.twig', [
            'current_menu' => 'admin',
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.recipe.delete", methods="DELETE")
     * @param Recipe $recipe
     * @param Request $request
     * @return Response
     */
    public function delete(Recipe $recipe, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $recipe->getId(), $request->get('_token'))) {

            $this->em->remove($recipe);
            $this->em->flush();
            $this->addFlash('success', "La recette a bien été supprimée.");
        }
        return $this->redirectToRoute('admin.recipe.index');
    }
}