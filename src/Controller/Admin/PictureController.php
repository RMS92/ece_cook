<?php


namespace App\Controller\Admin;


use App\Entity\ArticlePicture;
use App\Entity\EventPicture;
use App\Entity\RecipePicture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PictureController
 * @package App\Controller\Admin
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class PictureController extends AbstractController
{
    /**
     * @Route("/event-picture/{id}", name="admin.eventpicture.delete", methods="DELETE")
     * @param EventPicture $eventPicture
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteEventPicture(EventPicture $eventPicture, Request $request)
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

    /**
     * @Route("/article-picture/{id}", name="admin.articlepicture.delete", methods="DELETE")
     * @param ArticlePicture $articlePicture
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteArticlePicture(ArticlePicture $articlePicture, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if ($this->isCsrfTokenValid('delete'. $articlePicture->getId(), $data['_token'])) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($articlePicture);
            $entityManager->flush();
            return new JsonResponse(['success' => 1]);
        }

        return new JsonResponse(['error' => 'Token invalide'], 400);
    }

    /**
     * @Route("/recipe-picture/{id}", name="admin.recipepicture.delete", methods="DELETE")
     * @param RecipePicture $recipePicture
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteRecipePicture(RecipePicture $recipePicture, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if ($this->isCsrfTokenValid('delete'. $recipePicture->getId(), $data['_token'])) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recipePicture);
            $entityManager->flush();
            return new JsonResponse(['success' => 1]);
        }

        return new JsonResponse(['error' => 'Token invalide'], 400);
    }
}