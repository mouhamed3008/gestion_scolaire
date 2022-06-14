<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Form\InscriptionType;
use App\Repository\EtudiantRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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




    #[Route('/etudiant/add', name: 'add_etudiant')]
    public function add(Request $request, ManagerRegistry $doctrine)
    {
        $etudiant = new Etudiant();

         //$personne est l'image de notre form
         $form = $this->createForm(InscriptionType::class, $etudiant);

         //handleReq association la requete avec notre formular
         $form->handleRequest($request);

         //tester si le formulair est soumise
         if ($form->isSubmitted() && $form->isValid()) {
             //si on avait pas instancier profeeseur on pt recup le form avec $form->getData
             # code...
 
             $em = $doctrine->getManager();
          
             $em->persist($etudiant);
             $em->flush();
 
             $this->addFlash('success', "le professeur a été ajoutée avec succés");
         }

         return $this->render('etudiant/add.html.twig', [
            'title' => 'Ajout d\'un Étudiant',
            'form' => $form->createView()
        ]);
    }
}
