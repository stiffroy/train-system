<?php

namespace App\Controller;

use App\Entity\Locomotive;
use App\Form\LocomotiveType;
use App\Repository\LocomotiveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocomotivesController extends AbstractController
{
    #[Route('locomotives/{id}', name: 'locomotives_show', requirements: ['id' => '\d+'])]
    public function show(Locomotive $locomotive): Response
    {
        return $this->render('locomotives/show.html.twig', [
            'locomotive' => $locomotive,
        ]);
    }

    #[Route('locomotives/create', name: 'locomotives_create')]
    public function create(Request $request, LocomotiveRepository $repository): Response
    {
        dump('here');
        $form = $this->createForm(LocomotiveType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $repository->save($task, true);

            return $this->redirectToRoute('locomotives_list');
        }

        return $this->render('locomotives/form.html.twig', [
            'form' => $form,
        ]);
    }
}
