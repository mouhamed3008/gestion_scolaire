<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Entity\Inscription;
use App\Repository\ClasseRepository;
use App\Repository\EtudiantRepository;
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
        $etudiants = $repository->findAll();
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
            'etudiants' => $etudiants,
            'title'=> 'Liste des Étudiants'
        ]);
    }




    #[Route('/etudiant/add', name: 'add_etudiant')]
    public function add(Request $request, ManagerRegistry $doctrine, ClasseRepository $repository, UserPasswordHasherInterface $encoder)
    {
        $etudiant = new Etudiant();
        $inscription = new Inscription();
        $user = new User();


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
             $this->addFlash('success', "le professeur a été ajoutée avec succés");
             return $this->redirectToRoute("etudiant");
         }

         return $this->render('etudiant/add.html.twig', [
            'title' => 'Ajout d\'un Étudiant',
            'form' => $form->createView(),
            'classes' => $classes
        ]);
    }
}
