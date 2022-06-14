<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'app_etudiant')]
    public function index(EtudiantRepository $repository): Response
    {
        $etudiants = $repository->findAll();
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
            'etudiants' => $etudiants,
            'title'=> 'Liste des Étudiants'
        ]);
    }




    #[Route('/eudiant/add', name: 'add_professeur')]
    public function add(Request $request, ManagerRegistry $doctrine)
    {
        $professeur = new Professeur();

         //$personne est l'image de notre form
         $form = $this->createForm(ProfesseurType::class, $professeur);

         //handleReq association la requete avec notre formular
         $form->handleRequest($request);

         //tester si le formulair est soumise
         if ($form->isSubmitted() && $form->isValid()) {
             //si on avait pas instancier profeeseur on pt recup le form avec $form->getData
             # code...
 
             $em = $doctrine->getManager();
             $professeur->setCreatedBy($this->getUser());
             $professeur->setEtat(1);
             $em->persist($professeur);
             $em->flush();
 
             $this->addFlash('success', "le professeur a été ajoutée avec succés");
         }

         return $this->render('professeur/add.html.twig', [
            'title' => 'Ajout d\'un Professeur',
            'form' => $form->createView()
        ]);
    }
}
