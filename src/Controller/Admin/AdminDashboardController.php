<?php


namespace App\Controller\Admin;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminDashboardController
 * @package App\Controller\Admin
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/", name="admin.dashboard")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('admin/pages/dashboard.html.twig', [
            'current_menu' => 'admin'
        ]);
    }
}