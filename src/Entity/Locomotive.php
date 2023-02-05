<?php

namespace App\Entity;

use App\Enum\PropulsionType;
use App\Repository\LocomotiveRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocomotiveRepository::class)]
class Locomotive
{
    use BaseCoach;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $pullingPower = null;

    #[ORM\Column(type: 'string', enumType: PropulsionType::class)]
    private PropulsionType|null $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPullingPower(): ?int
    {
        return $this->pullingPower;
    }

    public function setPullingPower(int $pullingPower): self
    {
        $this->pullingPower = $pullingPower;

        return $this;
    }

    public function getType(): ?PropulsionType
    {
        return $this->type;
    }

    public function setType(PropulsionType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
