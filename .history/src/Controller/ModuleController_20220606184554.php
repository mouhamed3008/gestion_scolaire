<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Repository\ModuleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function index(ModuleRepository $repository, ManagerRegistry $doctrine, Request $request): Response
    {
        $module = new Module();

        $modules = $repository->findAll();


        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($module);
            $em->flush();
            return $this->redirectToRoute('app_module');
        }

        return $this->render('module/index.html.twig', [
            'title' => 'Liste des modules',
            'modules' => $modules,
            'form' => $form->createView()
        ]);
    }


}
