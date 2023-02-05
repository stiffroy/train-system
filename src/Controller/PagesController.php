<?php

namespace App\Controller;

use App\Repository\LocomotiveRepository;
use App\Repository\TrainRepository;
use App\Repository\WagonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    #[Route('/', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('pages/dashboard.html.twig');
    }

    #[Route('/trains', name: 'trains-list')]
    public function trainList(TrainRepository $repository): Response
    {
        return $this->render('pages/trains.html.twig', [
            'trains' => $repository->findAll(),
        ]);
    }

    #[Route('/locomotives', name: 'locomotives-list')]
    public function locomotiveList(LocomotiveRepository $repository): Response
    {
        return $this->render('pages/dashboard.html.twig', [
            'locomotives' => $repository->findAll(),
        ]);
    }

    #[Route('/wagons', name: 'wagons-list')]
    public function wagonList(WagonRepository $repository): Response
    {
        return $this->render('pages/dashboard.html.twig', [
            'locomotives' => $repository->findAll(),
        ]);
    }
}
