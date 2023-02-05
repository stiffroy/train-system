<?php

namespace App\Entity;

use App\Repository\TrainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainRepository::class)]
class Train
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'train', targetEntity: ElementConnector::class, cascade: ['persist'], orphanRemoval: true)]
    #[ORM\OrderBy(['elementOrder' => 'ASC'])]
    private Collection $elements;

    public function __construct()
    {
        $this->elements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, ElementConnector>
     */
    public function getElements(): Collection
    {
        return $this->elements;
    }

    public function addElement(ElementConnector $element): self
    {
        if (!$this->elements->contains($element)) {
            $this->elements->add($element);
            $element->setTrain($this);
        }

        return $this;
    }

    public function removeElement(ElementConnector $element): self
    {
        if ($this->elements->removeElement($element)) {
            // set the owning side to null (unless already changed)
            if ($element->getTrain() === $this) {
                $element->setTrain(null);
            }
        }

        return $this;
    }
}
