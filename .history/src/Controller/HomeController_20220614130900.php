<?php

namespace App\Controller;

use App\Repository\AnneeScolaireRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(     AnneeScolaireRepository $repo,
    Session $session): Response
    {
        if ($this->getUser()) {
            $annee = $repo->findOneBy(['isActif'=>1]);
            $session->set("annees", $annee);
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
