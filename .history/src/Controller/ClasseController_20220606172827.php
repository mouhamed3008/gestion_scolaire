<?php

namespace App\Controller;

use App\Repository\ClasseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'app_classe')]
    public function index(ClasseRepository $repository): Response
    {
        return $this->render('classe/index.html.twig', [
            'controller_name' => 'ClasseController',
        ]);
    }
}
