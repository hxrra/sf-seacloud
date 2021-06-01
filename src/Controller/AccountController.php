<?php

namespace App\Controller;

use App\Entity\DataCenter;
use App\Entity\Distribution;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
     * @Route ("/profile" , name="profile")
     */
    public function profile(): Response {
//        Affiche le template
        return $this->render('account/profile.html.twig');
    }

    /**
     * @Route ("/dashboard" , name="dashboard")
     */
    public function dashboard(): Response {
//        Affiche le template
        return $this->render('account/dashboard.html.twig');
    }

    /**
     * @Route ("/new-server" , name="new-server")
     */
    public function newserver(): Response {

        $form=$this->createFormBuilder()
            ->add('name', TextType::class )
            ->add('location', EntityType::class , [
                'class' => DataCenter::class,
                'choice_label' => 'name'
            ])
            ->add('distribution', EntityType::class , [
                'class' => Distribution::class,
                'choice_label' => 'name'
            ])
            ->add('cpu', RangeType::class)
            ->add('ram', RangeType::class)
            ->getForm();

//        Affiche le template
        return $this->render('account/new-server.html.twig',
            ['form'=>$form->createView(),]
        ) ;
    }
}
?>