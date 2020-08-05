<?php


namespace App\Controller\Admin;


use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminEventController
 * @package App\Controller\Admin
 * @Route("/admin")
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
     * @Route("/évènements", name="admin.event.index")
     * @return Response
     */
    public function index(): Response
    {
        $events = $this->repository->findAll();

        return $this->render('admin/event/index.html.twig', [
            'current_menu' => 'admin',
            'current_sub_menu' => 'admin_event',
            'events' => $events
        ]);
    }

    /**
     * @Route("/évènement/create", name="admin.event.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($event);
            $this->em->flush();
            $this->addFlash('success', "L'évènement a été correctement créé.");
            return $this->redirectToRoute('admin.event.index');
        }

        return $this->render('admin/event/new.html.twig', [
            'current_menu' => 'admin',
            'current_sub_menu' => 'admin_event',
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/évènement/{id}", name="admin.event.edit", methods="GET|POST")
     * @param Event $event
     * @param Request $request
     * @return Response
     */
    public function edit(Event $event, Request $request): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $event->setUpdatedAt(new \DateTime());

            $this->em->persist($event);
            $this->em->flush();
            $this->addFlash('success', "L'évènement a été correctement modifié.");
            return $this->redirectToRoute('admin.event.index');
        }

        return $this->render('admin/event/edit.html.twig', [
            'current_menu' => 'admin',
            'current_sub_menu' => 'admin_event',
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/évènement/{id}", name="admin.event.delete", methods="DELETE")
     * @param Event $event
     * @param Request $request
     * @return Response
     */
    public function delete(Event $event, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $event->getId(), $request->get('_token'))) {

            $this->em->remove($event);
            $this->em->flush();
            $this->addFlash('success', "L'évènement a bien été supprimé.");
        }
        return $this->redirectToRoute('admin.event.index');
    }
}