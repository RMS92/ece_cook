<?php


namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\RecipeRepository;
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

    public function __construct(EventRepository $eventRepository, RecipeRepository $recipeRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response
    {
        $events = $this->eventRepository->findLatest();
        $recipes = $this->recipeRepository->findLatest();

        return $this->render('pages/home.html.twig', [
            'current_menu' => 'home',
            'events' => $events,
            'recipes'=> $recipes
        ]);
    }
}