<?php


namespace App\Controller\Admin;


use App\Entity\EventPicture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PictureController
 * @package App\Controller\Admin
 * @Route("/admin/image")
 * @IsGranted("ROLE_ADMIN")
 */
class PictureController extends AbstractController
{
    /**
     * @Route("/{id}", name="admin.eventpicture.delete", methods="DELETE")
     * @param EventPicture $eventPicture
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(EventPicture $eventPicture, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if ($this->isCsrfTokenValid('delete'. $eventPicture->getId(), $data['_token'])) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($eventPicture);
            $entityManager->flush();
            return new JsonResponse(['success' => 1]);
        }

        return new JsonResponse(['error' => 'Token invalide'], 400);
    }
}