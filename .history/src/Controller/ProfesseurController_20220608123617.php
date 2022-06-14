<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Form\ProfesseurType;
use App\Repository\ProfesseurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfesseurController extends AbstractController
{
    #[Route('/professeurs', name: 'app_professeur')]
    public function index(ProfesseurRepository $repository): Response
    {
        $professeur = new Professeur();
        $profs = $repository->findAll();
        return $this->render('professeur/index.html.twig', [
            'professeurs' => $profs,
            'title' => 'Liste des Professeurs',
        ]);
    }



    #[Route('/professeur/add', name: 'add_professeur')]
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


    #[Route('/professeur/{id}', name: 'detail_prof')]
    public function detail(Professeur $professeur): Response
    {
        dd($professeur->classes);
        return $this->render('professeur/detail.html.twig', [
            'professeur' => $professeur,
            'title' => 'Detail du Professeur'
        ]);
    }


    #[Route('/professeur/edit/{id}', name: 'edit_prof', methods: ['POST', 'GET'])]
    public function edit(Professeur $professeur, Request $request, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(ProfesseurType::class, $professeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //si on avait pas instancier profeeseur on pt recup le form avec $form->getData
            # code...

            $em = $doctrine->getManager();
            $em->persist($professeur);
            $em->flush();

            $this->addFlash('success', "le professeur a été ajoutée avec succés");
            return $this->redirectToRoute('app_professeur');
        }

        return $this->render('professeur/edit.html.twig', [

            'title' => 'Modification d\'un Professeur',
            'form' => $form->createView()
        ]);
    }


    #[Route('/professeur/delete/{id}', name: 'delete_prof')]
    public function delete(): Response
    {
        // $form = $this->createForm(ProfesseurType::class, $professeur);
        return $this->render('professeur/index.html.twig', [
     
            'title' => 'Liste des Professeurs'
        ]);
    }
}
