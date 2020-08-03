<?php


namespace App\Controller\Admin;


use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class AdminUserController
 * @package App\Controller\Admin
 * @IsGranted("ROLE_ADMIN")
 */
class AdminUserController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private UserRepository $repository;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserRepository $repository, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->repository = $repository;
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/admin/utilisateurs", name="admin.user.index")
     * @return Response
     */
    public function index(): Response
    {
        $users = $this->repository->findAll();

        return $this->render('admin/user/index.html.twig', [
            'current_menu' => 'admin',
            'users' => $users
        ]);
    }

    /**
     * @Route("/admin/utilisateur/créer", name="admin.user.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', "L'utilisateur a bien été créer.");
            return $this->redirectToRoute('admin.user.index');
        }

        return $this->render('admin/user/new.html.twig', [
            'current_menu' => 'admin',
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/utilisateur/{id}", name="admin.user.edit", methods="GET|POST")
     * @param User $user
     * @param Request $request
     * @return Response
     */
    public function edit(User $user, Request $request): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $user->setUpdatedAt(new \DateTime());

            $this->em->flush();
            $this->addFlash('success', "L'utilisateur a été correctement modifié.");
            return $this->redirectToRoute('admin.user.index');
        }

        return $this->render('admin/user/edit.html.twig', [
            'current_menu' => 'admin',
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/utilisateur/{id}", name="admin.user.delete", methods="DELETE")
     * @param User $user
     * @param Request $request
     * @return Response
     */
    public function delete(User $user, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->get('_token'))) {

            $this->em->remove($user);
            $this->em->flush();
            $this->addFlash('success', "L'utilsateur a bien été supprimé.");
        }
        return $this->redirectToRoute('admin.user.index');
    }
}