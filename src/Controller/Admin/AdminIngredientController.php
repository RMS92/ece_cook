<?php


namespace App\Controller\Admin;


use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminIngredientController
 * @package App\Controller\Admin
 * @Route("/admin/ingrédients")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminIngredientController extends AbstractController
{
    /**
     * @var IngredientRepository
     */
    private IngredientRepository $repository;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    public function __construct(IngredientRepository $repository, EntityManagerInterface $em)
    {

        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/", name="admin.ingredient.index")
     * @return Response
     */
    public function index(): Response
    {
        $ingredients = $this->repository->findAll();

        return $this->render('admin/ingredient/index.html.twig', [
            'current_menu' => 'admin',
            'ingredients' => $ingredients
        ]);
    }

    /**
     * @Route("/créer", name="admin.ingredient.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($ingredient);
            $this->em->flush();
            $this->addFlash('success', "L'ingrédient a été correctement créé.");
            return $this->redirectToRoute('admin.ingredient.index');
        }

        return $this->render('admin/ingredient/new.html.twig', [
            'current_menu' => 'admin',
            'ingredient' => $ingredient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.ingredient.edit", methods="GET|POST")
     * @param Ingredient $ingredient
     * @param Request $request
     * @return Response
     */
    public function edit(Ingredient $ingredient, Request $request): Response
    {
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //$ingredient->setUpdatedAt(new \DateTime());

            $this->em->persist($ingredient);
            $this->em->flush();
            $this->addFlash('success', "L'ingrédient a été correctement modifié.");
            return $this->redirectToRoute('admin.ingredient.index');
        }

        return $this->render('admin/ingredient/edit.html.twig', [
            'current_menu' => 'admin',
            'ingredient' => $ingredient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.ingredient.delete", methods="DELETE")
     * @param Ingredient $ingredient
     * @param Request $request
     * @return Response
     */
    public function delete(Ingredient $ingredient, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $ingredient->getId(), $request->get('_token'))) {

            $this->em->remove($ingredient);
            $this->em->flush();
            $this->addFlash('success', "L'ingrédient a bien été supprimé.");
        }
        return $this->redirectToRoute('admin.ingredient.index');
    }
}