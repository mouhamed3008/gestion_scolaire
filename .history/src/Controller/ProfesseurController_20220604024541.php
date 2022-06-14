<?php

namespace App\Controller;

use App\Repository\ProfesseurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfesseurController extends AbstractController
{
    #[Route('/professeurs', name: 'app_professeur')]
    public function index(ProfesseurRepository $repository): Response
    {
        $profs = $repository->findAll();
        dd($profs);
        return $this->render('professeur/index.html.twig', [
            'professeurs' => $profs,
        ]);
    }
}