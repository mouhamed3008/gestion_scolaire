<?php

namespace App\Controller;

use App\Repository\ClasseRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'app_classe')]
    public function index(ClasseRepository $repository, Request $request, ManagerRegistry $doctrine): Response
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
        return $this->render('$0.html.twig', []);
    }
}
