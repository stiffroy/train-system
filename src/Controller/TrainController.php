<?php

namespace App\Controller;

use App\Entity\Train;
use App\Repository\LocomotiveRepository;
use App\Repository\WagonRepository;
use App\Service\TrainService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrainController extends AbstractController
{
    #[Route('trains/{id}', name: 'trains_show', requirements: ['id' => '\d+'])]
    public function show(Train $train): Response
    {
        return $this->render('train/show.html.twig', [
            'train' => $train,
        ]);
    }

    #[Route('trains/create', name: 'trains_create')]
    public function create(
        Request $request,
        TrainService $trainService,
        LocomotiveRepository $locomotiveRepository,
        WagonRepository $wagonRepository
    ): Response {
        if ($request->request->has('save')) {
            $trainService->createTrain($request->request->all());

            return $this->redirectToRoute('trains_list');
        }

        return $this->render('train/form.html.twig', [
            'locomotives' => $locomotiveRepository->findAll(),
            'wagons' => $wagonRepository->findAll(),
        ]);
    }
}
