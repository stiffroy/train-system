<?php

namespace App\Service;

use App\Entity\ElementConnector;
use App\Entity\Train;
use App\Repository\LocomotiveRepository;
use App\Repository\TrainRepository;
use App\Repository\WagonRepository;

class TrainService
{
    public function __construct(
        private readonly TrainRepository $trainRepository,
        private readonly LocomotiveRepository $locomotiveRepository,
        private readonly WagonRepository $wagonRepository,
    ) {
    }

    public function createTrain(array $data): Train
    {
        $order = 1;
        $train = new Train();
        $train->setName($data['name']);

        if (array_key_exists('locomotives', $data)) {
            foreach ($data['locomotives'] as $locomotive) {
                $element = $this->createLocomotiveConnector($locomotive, $order);
                $train->addElement($element);
                $order++;
            }
        }

        if (array_key_exists('wagons', $data)) {
            foreach ($data['wagons'] as $wagon) {
                $element = $this->createWagonConnector($wagon, $order);
                $train->addElement($element);
                $order++;
            }
        }

        $this->trainRepository->save($train, true);

        return $train;
    }

    public function saveChangesToTrain(Train $train, array $data): Train
    {
        if ($train->getName() !== $data['name']) {
            $train->setName($data['name']);
        }

        foreach ($train->getElements() as $element) {
            if (array_key_exists($element->getId(), $data['elements'])) {
                $elementValue = $data['elements'][$element->getId()];
                if (0 === $elementValue) {
                    $train->removeElement($element);
                } else {
                    $element->setElementOrder($elementValue);
                }
            } else {
                $train->removeElement($element);
            }
        }

        $this->trainRepository->save($train, true);

        return $train;
    }

    private function createLocomotiveConnector(int $locomotiveId, int $order): ElementConnector
    {
        $connector = new ElementConnector();
        $locomotive = $this->locomotiveRepository->find($locomotiveId);

        return $connector->setLocomotive($locomotive)
            ->setElementOrder($order)
        ;
    }

    private function createWagonConnector(int $wagonId, int $order): ElementConnector
    {
        $connector = new ElementConnector();
        $wagon = $this->wagonRepository->find($wagonId);

        return $connector->setWagon($wagon)
            ->setElementOrder($order)
        ;
    }
}