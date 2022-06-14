<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\ClasseRepository;
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
    public function add(Request $request, ManagerRegistry $doctrine, ClasseRepository $repository)
    {
        $etudiant = new Etudiant();
        $classes = $repository->findAll();


         
         $form = $this->createForm(EtudiantType::class, $etudiant);
         $form->handleRequest($request);

       
         if ($form->isSubmitted() && $form->isValid()) { 
             $em = $doctrine->getManager();
             $em->persist($etudiant);
             $em->flush();
             $this->addFlash('success', "le professeur a été ajoutée avec succés");
         }

         return $this->render('etudiant/add.html.twig', [
            'title' => 'Ajout d\'un Étudiant',
            'form' => $form->createView(),
            'classes' => $classes
        ]);
    }
}
