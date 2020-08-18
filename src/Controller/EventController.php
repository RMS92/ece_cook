<?php


namespace App\Controller;


use App\Entity\Event;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @var EventRepository
     */
    private EventRepository $repository;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    public function __construct(EventRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/évènements", name="event.index")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $events = $this->repository->paginateAllVisible($request->query->getInt('page', 1));

        return $this->render('event/index.html.twig', [
            'current_menu' => 'event',
            'events' => $events
        ]);
    }

    /**
     * @Route("/évènements/{slug}-{id}", name="event.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Event $event
     * @param string $slug
     * @param Request $request
     * @return Response
     */
    public function show(Event $event, string $slug, Request $request): Response
    {
        if ($event->getSlug() !== $slug) {
            return $this->redirectToRoute('event.show', [
                'id' => $event->getId(),
                'slug' => $event->getSlug(),
            ], 301);
        }

        return $this->render('event/show.html.twig', [
            'current_menu' => 'event',
            'event' => $event
        ]);
    }
}