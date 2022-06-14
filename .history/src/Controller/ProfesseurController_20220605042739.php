<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Form\ProfesseurType;
use App\Repository\ProfesseurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfesseurController extends AbstractController
{
    #[Route('/professeurs', name: 'app_professeur')]
    public function index(ProfesseurRepository $repository, Request $request, ManagerRegistry $doctrine): Response
    {
        $profs = $repository->findAll();
        $professeur = new Professeur();
        //$personne est l'image de notre form
        $form = $this->createForm(ProfesseurType::class, $professeur);


        //handleReq association la requete avec notre formular
        $form->handleRequest($request);

        //tester si le formulair est soumise
        if ($form->isSubmitted()) {
            //si on avait pas instancier profeeseur on pt recup le form avec $form->getData
            # code...
        }

        return $this->render('professeur/index.html.twig', [
            'professeurs' => $profs,
            'title' => 'Liste des Professeurs',
            'form' => $form->createView()
        ]);
    }


    #[Route('/professeur/{id}', name: 'detail_prof')]
    public function detail(ProfesseurRepository $repository): Response
    {
        $profs = $repository->findAll();
        return $this->render('professeur/index.html.twig', [
            'professeurs' => $profs,
            'title' => 'Liste des Professeurs'
        ]);
    }


    #[Route('/professeur/edit/{id}', name: 'edit_prof')]
    public function edit(ProfesseurRepository $repository): Response
    {
        $profs = $repository->findAll();
        return $this->render('professeur/index.html.twig', [
            'professeurs' => $profs,
            'title' => 'Liste des Professeurs'
        ]);
    }


    #[Route('/professeur/delete/{id}', name: 'delete_prof')]
    public function delete(ProfesseurRepository $repository): Response
    {
        $profs = $repository->findAll();
        return $this->render('professeur/index.html.twig', [
            'professeurs' => $profs,
            'title' => 'Liste des Professeurs'
        ]);
    }
}
