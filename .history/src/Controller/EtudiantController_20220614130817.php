<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Entity\Inscription;
use App\Form\InscriptionType;
use App\Service\MailerService;
use App\Repository\ClasseRepository;
use App\Repository\InscriptionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'app_etudiant')]
    public function index(InscriptionRepository $repository): Response
    {
        $inscriptions = $repository->findAll();
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
            'inscriptions' => $inscriptions,
            'title'=> 'Liste des Étudiants'
        ]);
    }




    #[Route('/etudiant/add', name: 'add_etudiant')]
    public function add(Request $request, ManagerRegistry $doctrine, ClasseRepository $repository, MailerService $mailer, Session $session)
    {
        $etudiant = new Etudiant();
        $mat = "MAT".date("YmdHis");
        $inscription = new Inscription();
        $classes = $repository->findAll();


         
         $form = $this->createForm(InscriptionType::class, $inscription);
         $form->handleRequest($request);
        
        
         if ($form->isSubmitted() ) { 
             $em = $doctrine->getManager();
             $inscription->setUser($this->getUser());
             $inscription->setAnneeScolaire($session->get('annee'));
             $em->persist($inscription);
             $em->flush();
             $mailer->sendEmail(content:'Vous avez été ajouté avec success');
             $this->addFlash('success', "le professeur a été ajoutée avec succés");
             return $this->redirectToRoute("app_etudiant");
         }

         return $this->render('etudiant/add.html.twig', [
            'title' => 'Ajout d\'un Étudiant',
            'form' => $form->createView(),
            'classes' => $classes
        ]);
    }
}
