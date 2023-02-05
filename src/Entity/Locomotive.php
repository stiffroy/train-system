<?php

namespace App\Entity;

use App\Enum\PropulsionType;
use App\Repository\LocomotiveRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocomotiveRepository::class)]
class Locomotive implements CoachInterface
{
    use BaseCoach;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $pullingPower = null;

    #[ORM\Column]
    private int $maxPayload = 0;

    #[ORM\Column(type: 'string', enumType: PropulsionType::class)]
    private PropulsionType|null $type = null;

    #[ORM\OneToOne(mappedBy: 'locomotive', cascade: ['persist', 'remove'])]
    private ?ElementConnector $elementConnector = null;

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

    public function getMaxPayload(): int
    {
        return $this->maxPayload;
    }

    public function setMaxPayload(int $maxPayload): self
    {
        $this->maxPayload = $maxPayload;

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

    public function getElementConnector(): ?ElementConnector
    {
        return $this->elementConnector;
    }

    public function setElementConnector(?ElementConnector $elementConnector): self
    {
        // unset the owning side of the relation if necessary
        if ($elementConnector === null && $this->elementConnector !== null) {
            $this->elementConnector->setLocomotive(null);
        }

        // set the owning side of the relation if necessary
        if ($elementConnector !== null && $elementConnector->getLocomotive() !== $this) {
            $elementConnector->setLocomotive($this);
        }

        $this->elementConnector = $elementConnector;

        return $this;
    }
}
