<?php

namespace App\Service;

use App\Entity\Locomotive;
use App\Entity\Train;
use App\Entity\Wagon;

class TrainInfoService
{
    private const CONDUCTOR_PER_PASSENGERS = 50;
    public function getTrainInfo(Train $train): array
    {
        $trainWeight = $this->getTotalWeight($train);
        $trainLength = $this->getTotalLength($train);
        $maxPassengers = $this->getTotalMaxPassenger($train);
        $maxGoodsWeight = $this->getTotalMaxGoodsWeight($train);
        $maxPeopleWeight = $this->getTotalMaxPeopleWeight($train);
        $maxPayload = $maxPeopleWeight + $maxGoodsWeight;
        $canDrive = $this->canDrive($train, $maxPayload) ? 'Yes' : 'No';
        $noOfConductor = $this->noOfConductorsNeeded($maxPassengers);

        return [
            'emptyWeight' => $trainWeight,
            'maxPassengers' => $maxPassengers,
            'maxGoodsWeight' => $maxGoodsWeight,
            'maxPayload' => $maxPayload,
            'totalMaxWeight' => $trainWeight + $maxPayload,
            'totalLength' => $trainLength,
            'canDrive' => $canDrive,
            'noOfConductors' => $noOfConductor,
        ];
    }

    private function getTotalWeight(Train $train): float
    {
        $weight = 0;

        foreach ($train->getElements() as $connector) {
            $weight += $connector->getElement()->getWeight();
        }

        return $weight;
    }

    private function getTotalLength(Train $train): float
    {
        $length = 0;

        foreach ($train->getElements() as $connector) {
            $length += $connector->getElement()->getLength();
        }

        return $length;
    }

    private function getTotalMaxPassenger(Train $train): float
    {
        $passenger = 0;

        foreach ($train->getElements() as $connector) {
            if ($connector->getElement() instanceof Wagon) {
                $passenger += $connector->getElement()->getMaxPassenger();
            }
        }

        return $passenger;
    }

    private function getTotalMaxGoodsWeight(Train $train): float
    {
        $weight = 0;

        foreach ($train->getElements() as $connector) {
            if ($connector->getElement() instanceof Wagon) {
                $weight += $connector->getElement()->getMaxGoodsWeight();
            }
        }

        return $weight;
    }

    private function getTotalMaxPeopleWeight(Train $train): float
    {
        $weight = 0;

        foreach ($train->getElements() as $connector) {
            $weight += $connector->getElement()->getMaxPassenger() * 75;
        }

        return $weight;
    }

    private function canDrive(Train $train, $maxCalculatedPayload): bool
    {
        $possiblePayload = 0;

        foreach ($train->getElements() as $connector) {
            if ($connector->getElement() instanceof Locomotive) {
                $possiblePayload += $connector->getElement()->getMaxPayload();
            }
        }

        return $possiblePayload >$maxCalculatedPayload;
    }

    private function noOfConductorsNeeded(int $noOfPassengers): int
    {
        if ($noOfPassengers > 0) {
            $number = $noOfPassengers / self::CONDUCTOR_PER_PASSENGERS;

            return $number * self::CONDUCTOR_PER_PASSENGERS === $noOfPassengers
                ? $number
                : $number + 1
            ;
        }

        return 0;
    }
}