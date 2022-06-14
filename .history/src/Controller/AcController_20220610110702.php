<?php

namespace App\Controller;

use App\Repository\AcRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
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
    public function add(Request $request, ManagerRegistry $doctrine): Response
    {
        $professeur = new Professeur();

        //$personne est l'image de notre form
        $form = $this->createForm(ProfesseurType::class, $professeur);

        //handleReq association la requete avec notre formular
        $form->handleRequest($request);
        return $this->render('ac/add.html.twig', [
            'title' => 'Liste des Attachés de Classes',
            'acs' => $acs
        ]);
    }


}
