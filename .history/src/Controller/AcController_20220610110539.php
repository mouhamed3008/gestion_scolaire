<?php

namespace App\Controller;

use App\Repository\AcRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AcController extends AbstractController
{
    #[Route('/ac', name: 'app_ac')]
    public function index(AcRepository $repository): Response
    {
        $acs = $repository->findAll();
        return $this->render('ac/index.html.twig', [
            'title' => 'Liste des Attachés de Classes',
            'acs' => $acs
        ]);
    }


    #[Route('/ac/add', name: 'app_ac')]
    public function add(): Response
    {
        return $this->render('ac/index.html.twig', [
            'title' => 'Liste des Attachés de Classes',
            'acs' => $acs
        ]);
    }


}
