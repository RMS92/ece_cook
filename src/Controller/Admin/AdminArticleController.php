<?php


namespace App\Controller\Admin;


use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminArticleController
 * @package App\Controller\Admin
 * @Route("/front_5694/admin/articles")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminArticleController extends AbstractController
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
     * @Route("/", name="admin.article.index")
     * @return Response
     */
    public function index(): Response
    {
        $articles = $this->repository->findAll();

        return $this->render('admin/article/index.html.twig', [
            'current_menu' => 'admin',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/créer", name="admin.article.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($article);
            $this->em->flush();
            $this->addFlash('success', "L'article a été correctement créé.");
            return $this->redirectToRoute('admin.article.index');
        }

        return $this->render('admin/article/new.html.twig', [
            'current_menu' => 'admin',
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.article.edit", methods="GET|POST")
     * @param Article $article
     * @param Request $request
     * @return Response
     */
    public function edit(Article $article, Request $request): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $article->setUpdatedAt(new \DateTime());

            $this->em->persist($article);
            $this->em->flush();
            $this->addFlash('success', "L'article a été correctement modifié.");
            return $this->redirectToRoute('admin.article.index');
        }

        return $this->render('admin/article/edit.html.twig', [
            'current_menu' => 'admin',
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.article.delete", methods="DELETE")
     * @param Article $article
     * @param Request $request
     * @return Response
     */
    public function delete(Article $article, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->get('_token'))) {

            $this->em->remove($article);
            $this->em->flush();
            $this->addFlash('success', "L'article a bien été supprimé.");
        }
        return $this->redirectToRoute('admin.article.index');
    }
}