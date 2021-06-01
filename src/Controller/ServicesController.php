<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController {
    /**
     * @Route ("/services", name="page_services")
     *
     * @return Response
     */
    public function services(): Response {
        return $this->render('pages/services.html.twig');

    }
}
