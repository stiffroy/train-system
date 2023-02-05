<?php

namespace App\Controller;

use App\Entity\Wagon;
use App\Form\WagonType;
use App\Repository\WagonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WagonController extends AbstractController
{
    #[Route('wagons/{id}', name: 'wagons_show', requirements: ['id' => '\d+'])]
    public function show(Wagon $wagon): Response
    {
        return $this->render('wagon/show.html.twig', [
            'wagon' => $wagon,
        ]);
    }

    #[Route('wagons/create', name: 'wagons_create')]
    public function create(Request $request, WagonRepository $repository): Response
    {
        $form = $this->createForm(WagonType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $repository->save($task, true);

            return $this->redirectToRoute('wagons_list');
        }

        return $this->render('wagon/form.html.twig', [
            'form' => $form,
        ]);
    }
}
