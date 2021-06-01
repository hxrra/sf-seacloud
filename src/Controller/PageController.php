<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PageController extends AbstractController {
    /**
     * @Route ("/", name="page_home")
     *
     * @return Response
     */
    public function home(): Response {
        // redirection vers la template home.html
        return $this->render('pages/home.html.twig');

//        return new Response('Home page');
    }
}

?>