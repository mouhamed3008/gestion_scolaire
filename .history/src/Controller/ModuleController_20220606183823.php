<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function index(ClasseRepository $repository): Response
    {
        $classes = $repository->findAll();
        return $this->render('classe/index.html.twig', [
            'title' => 'Liste des classes',
            'classes' => $classes,
        ]);
    }


    #[Route('/classe/add', name: 'add_classe')]
    public function add(Request $request, ManagerRegistry $doctrine): Response
    {
        $classe = new Classe();

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
