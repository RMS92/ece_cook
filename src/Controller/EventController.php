<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/évènements", name="event.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('event/index.html.twig', [
            'current_menu' => 'event'
        ]);
    }

    /**
     * @Route("/évènements/évènement-id", name="event.show")
     * @return Response
     */
    public function show(): Response
    {
        return $this->render('event/show.html.twig', [
            'current_menu' => 'event'
        ]);
    }
}