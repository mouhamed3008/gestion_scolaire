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
            'title'=> 'Liste des √Čtudiants'
        ]);
    }




    #[Route('/etudiant/add', name: 'add_etudiant')]
    public function add(Request $request, ManagerRegistry $doctrine, ClasseRepository $repository, MailerService $mailer)
    {
        $etudiant = new Etudiant();
        $inscription = new Inscription();
        $classes = $repository->findAll();


         
         $form = $this->createForm(InscriptionType::class, $inscription);
         $form->handleRequest($request);

        
         if ($form->isSubmitted() ) { 
             dd($form['etudiant']);

             $em = $doctrine->getManager();
             $matricule = "MAT-".date("YmdHis");
             $etudiant->setMatricule($matricule);
             $etudiant->setRoles(["ROLE_ETUDIANT"]);
             $etudiant->setNomComplet($form['etudiant']->get('nomComplet'));
             $etudiant->setAdresse($form['etudiant']->get('adresse'));
             $etudiant->setEmail($form['etudiant']->get('email'));
             $etudiant->setSexe($form['etudiant']->get('sexe'));
             $inscription->setEtudiant($etudiant);
             $inscription->setUser($this->getUser());
             $em->persist($inscription);
             $em->flush();

             $mailer->sendEmail(content:'Vous avez √©t√© ajout√© avec success');
             $this->addFlash('success', "le professeur a √©t√© ajout√©e avec succ√©s");
             return $this->redirectToRoute("app_etudiant");
         }

         return $this->render('etudiant/add.html.twig', [
            'title' => 'Ajout d\'un √Čtudiant',
            'form' => $form->createView(),
            'classes' => $classes
        ]);
    }
}
