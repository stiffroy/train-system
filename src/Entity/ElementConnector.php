<?php

namespace App\Entity;

use App\Repository\ElementConnectorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElementConnectorRepository::class)]
class ElementConnector
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $elementOrder = null;

    #[ORM\OneToOne(inversedBy: 'elementConnector', cascade: ['persist'])]
    private ?Locomotive $locomotive = null;

    #[ORM\OneToOne(inversedBy: 'elementConnector', cascade: ['persist'])]
    private ?Wagon $wagon = null;

    #[ORM\ManyToOne(inversedBy: 'elements')]
    private ?Train $train = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getElementOrder(): ?int
    {
        return $this->elementOrder;
    }

    public function setElementOrder(int $elementOrder): self
    {
        $this->elementOrder = $elementOrder;

        return $this;
    }

    public function getElement(): CoachInterface
    {
        return $this->locomotive ?? $this->wagon;
    }

    public function setElement(CoachInterface $element): self
    {
        if ($element instanceof Locomotive) {
            $this->locomotive = $element;
        }

        if ($element instanceof Wagon) {
            $this->wagon = $element;
        }

        return $this;
    }

    public function getLocomotive(): ?Locomotive
    {
        return $this->locomotive;
    }

    public function setLocomotive(?Locomotive $locomotive): self
    {
        $this->locomotive = $locomotive;

        return $this;
    }

    public function getWagon(): ?Wagon
    {
        return $this->wagon;
    }

    public function setWagon(?Wagon $wagon): self
    {
        $this->wagon = $wagon;

        return $this;
    }

    public function getTrain(): ?Train
    {
        return $this->train;
    }

    public function setTrain(?Train $train): self
    {
        $this->train = $train;

        return $this;
    }
}
