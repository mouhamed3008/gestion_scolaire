<?php

namespace App\Controller;

use App\Entity\Module;
use App\Repository\ModuleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function index(ModuleRepository $repository): Response
    {
        $classe = new Module();

        $classes = $repository->findAll();


        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($classe);
            $em->flush();
            return $this->redirectToRoute('app_classe');
        }

        return $this->render('classe/index.html.twig', [
            'title' => 'Liste des classes',
            'classes' => $classes,
        ]);
    }


    #[Route('/classe/add', name: 'add_classe')]
    public function add(Request $request, ManagerRegistry $doctrine): Response
    {
        $classe = new Module();

        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($classe);
            $em->flush();
            return $this->redirectToRoute('app_classe');
        }
        return $this->render('classe/add.html.twig', [
            'title' => 'Ajout d\'une classe',
            'form' => $form->createView()
        ]);
    }
}
