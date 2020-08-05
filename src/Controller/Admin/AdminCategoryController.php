<?php


namespace App\Controller\Admin;


use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminCategoryController
 * @package App\Controller\Admin
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminCategoryController extends AbstractController
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $repository;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    public function __construct(CategoryRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/catégories", name="admin.category.index")
     * @return Response
     */
    public function index(): Response
    {
        $categories = $this->repository->findAll();

        return $this->render('admin/category/index.html.twig', [
            'current_menu' => 'admin',
            'current_sub_menu' => 'admin_category',
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/catégorie/create", name="admin.category.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($category);
            $this->em->flush();
            $this->addFlash('success', "La catégorie a été correctement créée.");
            return $this->redirectToRoute('admin.category.index');
        }

        return $this->render('admin/category/new.html.twig', [
            'current_menu' => 'admin',
            'current_sub_menu' => 'admin_category',
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/catégorie/{id}", name="admin.category.edit", methods="GET|POST")
     * @param Category $category
     * @param Request $request
     * @return Response
     */
    public function edit(Category $category, Request $request): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $category->setUpdatedAt(new \DateTime());

            $this->em->persist($category);
            $this->em->flush();
            $this->addFlash('success', "La catégorie a été correctement modifiée.");
            return $this->redirectToRoute('admin.category.index');
        }

        return $this->render('admin/category/edit.html.twig', [
            'current_menu' => 'admin',
            'current_sub_menu' => 'admin_category',
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/catégorie/{id}", name="admin.category.delete", methods="DELETE")
     * @param Category $category
     * @param Request $request
     * @return Response
     */
    public function delete(Category $category, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->get('_token'))) {

            $this->em->remove($category);
            $this->em->flush();
            $this->addFlash('success', "La catégorie a bien été supprimée.");
        }
        return $this->redirectToRoute('admin.category.index');
    }
}