<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait BaseCoach
{
    #[ORM\Column]
    private ?float $weight = null;

    #[ORM\Column]
    private ?float $length = null;

    #[ORM\Column]
    private int $maxPassenger = 0;

    #[ORM\Column]
    private ?string $manufacturer = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $yearOfManufacture = null;

    #[ORM\Column(unique: true)]
    private ?string $serialNo = null;

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(float $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getMaxPassenger(): int
    {
        return $this->maxPassenger;
    }

    public function setMaxPassenger(int $maxPassenger): self
    {
        $this->maxPassenger = $maxPassenger;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getYearOfManufacture(): ?\DateTimeInterface
    {
        return $this->yearOfManufacture;
    }

    public function setYearOfManufacture(\DateTimeInterface $yearOfManufacture): self
    {
        $this->yearOfManufacture = $yearOfManufacture;

        return $this;
    }

    public function getSerialNo(): ?string
    {
        return $this->serialNo;
    }

    public function setSerialNo(string $serialNo): self
    {
        $this->serialNo = $serialNo;

        return $this;
    }
}
