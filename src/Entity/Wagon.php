<?php

namespace App\Entity;

use App\Enum\WagonType;
use App\Repository\WagonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WagonRepository::class)]
class Wagon
{
    use BaseCoach;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', enumType: WagonType::class)]
    private ?WagonType $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?WagonType
    {
        return $this->type;
    }

    public function setType(WagonType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
