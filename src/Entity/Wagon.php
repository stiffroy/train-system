<?php

namespace App\Entity;

use App\Enum\WagonType;
use App\Repository\WagonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WagonRepository::class)]
class Wagon implements CoachInterface
{
    use BaseCoach;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', enumType: WagonType::class)]
    private ?WagonType $type = null;

    #[ORM\OneToOne(mappedBy: 'wagon', cascade: ['persist', 'remove'])]
    private ?ElementConnector $elementConnector = null;

    #[ORM\Column]
    private ?float $maxGoodsWeight = null;

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

    public function getElementConnector(): ?ElementConnector
    {
        return $this->elementConnector;
    }

    public function setElementConnector(?ElementConnector $elementConnector): self
    {
        // unset the owning side of the relation if necessary
        if ($elementConnector === null && $this->elementConnector !== null) {
            $this->elementConnector->setWagon(null);
        }

        // set the owning side of the relation if necessary
        if ($elementConnector !== null && $elementConnector->getWagon() !== $this) {
            $elementConnector->setWagon($this);
        }

        $this->elementConnector = $elementConnector;

        return $this;
    }

    public function getMaxGoodsWeight(): ?float
    {
        return $this->maxGoodsWeight;
    }

    public function setMaxGoodsWeight(float $maxGoodsWeight): self
    {
        $this->maxGoodsWeight = $maxGoodsWeight;

        return $this;
    }
}
