<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(     AnneeScolaireRepository $repo,
    SessionInterface $session): Response
    {
        if ($this->getUser()) {
            $annee = $repo->findAll();
            dd($annee);
            $session->set("annees", $annee);
            return $this->redirectToRoute('/');
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
