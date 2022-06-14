<?php

namespace App\Controller;

use App\Repository\AcRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AcController extends AbstractController
{
    #[Route('/ac', name: 'app_ac')]
    public function index(AcRepository $repository): Response
    {
        return $this->render('ac/index.html.twig', [
            'controller_name' => 'AcController',
        ]);
    }
}
