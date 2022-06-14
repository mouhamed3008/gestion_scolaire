<?php

namespace App\Controller;

use App\Entity\Ac;
use App\Form\UserType;
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


    #[Route('/ac/add', name: 'add_ac')]
    public function add(Request $request, ManagerRegistry $doctrine): Response
    {
        $ac = new Ac();

        
        $form = $this->createForm(UserType::class, $ac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $doctrine->getManager();
            $ac->setRoles(["ROLE_AC"]);
            $ac->setEtat(1);
            $em->persist($ac);
            $em->flush();
            $this->addFlash('success', "le professeur a été ajoutée avec succés");
            return $this->redirectToRoute('app_ac');
           
        }


        return $this->render('ac/add.html.twig', [
            'title' => 'Ajout d\'un Attaché de Classes',
            'form' => $form->createView()
        ]);
    }


}
