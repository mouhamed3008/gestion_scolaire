<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Entity\Inscription;
use App\Service\MailerService;
use App\Repository\ClasseRepository;
use App\Repository\InscriptionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'app_etudiant')]
    public function index(InscriptionRepository $repository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_RP');
        $inscriptions = $repository->findAll();
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
            'inscriptions' => $inscriptions,
            'title'=> 'Liste des √Čtudiants'
        ]);
    }




    #[Route('/etudiant/add', name: 'add_etudiant')]
    public function add(Request $request, ManagerRegistry $doctrine, ClasseRepository $repository, UserPasswordHasherInterface $encoder, MailerService $mailer)
    {
        $etudiant = new Etudiant();
        $inscription = new Inscription();
        $classes = $repository->findAll();


         
         $form = $this->createForm(EtudiantType::class, $etudiant);
         $form->handleRequest($request);

       
         if ($form->isSubmitted() && $form->isValid()) { 
             $em = $doctrine->getManager();
             $classe = $repository->find($request->get('classe'));
             $password = "passer";
             $matricule = "MAT-".date("YmdHis");
             $etudiant->setMatricule($matricule);
             $etudiant->setRoles(["ROLE_ETUDIANT"]);
             $passwordHash = $encoder->hashPassword($etudiant,$password);
             $etudiant->setPassword($passwordHash);
             $em->persist($etudiant);
             $inscription->setEtudiant($etudiant);
             $inscription->setUser($this->getUser());
             $inscription->setClasse($classe);
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
