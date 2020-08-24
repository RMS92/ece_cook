<?php


namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\EventRepository;
use App\Repository\RecipeRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var EventRepository
     */
    private EventRepository $eventRepository;
    /**
     * @var RecipeRepository
     */
    private RecipeRepository $recipeRepository;
    /**
     * @var ArticleRepository
     */
    private ArticleRepository $articleRepository;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    public function __construct(EventRepository $eventRepository, RecipeRepository $recipeRepository, UserRepository $userRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->recipeRepository = $recipeRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response
    {
        $events = $this->eventRepository->findLatest();
        $recipes = $this->recipeRepository->findLatest();
        $users = $this->userRepository->findAll();


        return $this->render('pages/home.html.twig', [
            'current_menu' => 'home',
            'events' => $events,
            'recipes' => $recipes,
            'users' => $users
        ]);
    }
}