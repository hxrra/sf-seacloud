<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/account" , name="account_")
 **/

class AccountController extends AbstractController {
    /**
     * @Route ("/")
     */
    public function index(): Response {
//        redirection vers la page dashboard : exemple quelqu'un qui faire ip/account sera redirigé vers le dashboard
        return $this->redirectToRoute('page_home');
    }
    /**
     * @Route ("/profile" , name="account_profile")
     */
    public function profile(): Response {
//        Affiche le template
        return $this->render('account/profile.html.twig');
    }

    /**
     * @Route ("/dashboard" , name="account_dashboard")
     */
    public function dashboard(): Response {
//        Affiche le template
        return $this->render('account/dashboard.twig');
    }
}
?>