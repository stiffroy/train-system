<?php

namespace App\Entity;

interface CoachInterface
{
    public function getId();
    public function getWeight();
    public function getLength();
    public function getMaxPassenger();
}