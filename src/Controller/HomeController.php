<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/test', name: 'titi', methods: ['Get'])]
    public function abcd(): Response
    {
        return $this->render('utilisateur/test.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }










    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/sidebar', name: 'sidebar')]
    public function sidebar(): Response
    {
        return $this->render(
            'sidebar.html.twig',
            [
                'controller_name' => 'HomeController',
            ]
        );
    }

    #[Route('/toto', name: 'toto')]
    public function toto(): Response
    {
        return $this->render(
            'toto.html.twig',
            [
                'controller_name' => 'HomeController',
            ]
        );
    }
}
