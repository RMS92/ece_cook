<?php


namespace App\Controller;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @var ArticleRepository
     */
    private ArticleRepository $repository;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    public function __construct(ArticleRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/boutique", name="article.index")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $articles = $this->repository->paginateAllVisible($request->query->getInt('page', 1));

        return $this->render('article/index.html.twig', [
            'current_menu' => 'article',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/boutique/{slug}-{id}", name="article.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Article $article
     * @param string $slug
     * @param Request $request
     * @return Response
     */
    public function show(Article $article, string $slug, Request $request): Response
    {
        if ($article->getSlug() !== $slug) {
            return $this->redirectToRoute('article.show', [
                'id' => $article->getId(),
                'slug' => $article->getSlug(),
            ], 301);
        }

        return $this->render('article/show.html.twig', [
            'current_menu' => 'article',
            'article' => $article
        ]);
    }
}