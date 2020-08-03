<?php


namespace App\Controller\Admin;


use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminEventController
 * @package App\Controller\Admin
 * @IsGranted("ROLE_ADMIN")
 */
class AdminEventController extends AbstractController
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
     * @Route("/admin/évènements", name="admin.event.index")
     * @return Response
     */
    public function index(): Response
    {
        $events = $this->repository->findAll();

        return $this->render('admin/event/index.html.twig', [
            'current_menu' => 'admin',
            'events' => $events
        ]);
    }
}