<?php

namespace App\Controller;

use App\Entity\DataCenter;
use App\Entity\Distribution;
use App\Entity\Server;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/account" , name="account_")
 **/

class AccountController extends AbstractController
{
    /**
     * @Route ("/")
     */
    public function index(): Response
    {
//        redirection vers la page dashboard : exemple quelqu'un qui faire ip/account sera redirigé vers le dashboard
        return $this->redirectToRoute('page_home');
    }

    /**
     * @Route ("/profile" , name="profile")
     */
    public function profile(): Response
    {
//        Affiche le template
        return $this->render('account/profile.html.twig');
    }

    /**
     * @Route ("/dashboard" , name="dashboard")
     */
    public function dashboard(): Response
    {

        $repository = $this->getDoctrine()->getrepository(server::class);

        $servers = $repository->findBy(['user' => $this->getUser()]);

        return $this->render('account/dashboard.html.twig', ['servers' => $servers]);
    }

    /**
     * @Route ("/{id}/server-detail" , name="server_detail")
     */
    public function detail($id): Response
    {
        $repository = $this->getDoctrine()->getrepository(server::class);

        $serverdetail = $repository->find($id);

        return $this->render('account/server-detail.html.twig', ['servers' => $serverdetail]);

    }

    /**
     * @Route ("/{id}/reboot" , name="server_reboot", requirements={"id":"\d+"})
     */
    public function reboot(int $id): Response
    {
        /** @var Server $server */
        $server = $repository->findBy(['user' => $this->getUser()]);

        $server->setState(Server::STATE_STOPPED);

        $entityManager->persist($server);
        $entityManager->flush();


        return $this->redirectToRoute('account_dashboard');
    }

    /**
     * @Route ("/new-server" , name="new-server")
     */
    public function newserver(Request $request): Response
    {
        $newserver = new Server();

        $user = $this-> getUser();

        $newserver-> setUser($user);

        $form = $this->createFormBuilder($newserver, [
            'data_class' => Server::class
        ])
            ->add('name', TextType::class)
            ->add('location', EntityType::class, [
                'class' => DataCenter::class,
                'choice_label' => 'name'
            ])
            ->add('distribution', EntityType::class, [
                'class' => Distribution::class,
                'choice_label' => 'name'
            ])
            ->add('cpu', RangeType::class, [
                'label' => 'CPU',
                'attr' =>
                    [
                        'min' => 1,
                        'max' => 16
                    ]
            ])
            ->add('ram', RangeType::class, [
                'label' => 'RAM',
                'attr' =>
                    [
                        'min' => 1,
                        'max' => 16,
                        'step' => 2
                    ]])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newserver);
            $entityManager->flush();


            return $this->redirectToRoute('account_dashboard');

        }

        // Affiche le template

        return $this->Render('account/new-server.html.twig',
            ['form' => $form->createView(),]
        );
    }
}


