<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController {
    /**
     * @Route ("/about", name="page_about")
     *
     * @return Response
     */
    public function about(): Response {
        return $this->render('pages/about.html.twig');

    }
}
