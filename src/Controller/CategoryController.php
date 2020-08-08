<?php


namespace App\Controller;


use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
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
     * @Route("/catégorie/{slug}-{id}", name="category.show")
     * @param Category $category
     * @param string $slug
     * @param Request $request
     * @return Response
     */
    public function show(Category $category, string $slug, Request $request): Response
    {
        if ($category->getSlug() !== $slug) {
            return $this->redirectToRoute('event.show', [
                'id' => $category->getId(),
                'slug' => $category->getSlug(),
            ], 301);
        }

        return $this->render('category/show.html.twig', [
            'current_menu' => 'recipe',
            'category' => $category
        ]);
    }
}