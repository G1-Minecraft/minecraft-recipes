<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CraftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CraftRepository::class)]
#[ApiResource]
class Craft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'crafts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Item $result = null;

    #[ORM\Column]
    private ?int $resultAmount = null;

    #[ORM\OneToMany(mappedBy: 'craft', targetEntity: CraftSlot::class, orphanRemoval: true)]
    private Collection $craftSlots;

    public function __construct()
    {
        $this->craftSlots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResult(): ?Item
    {
        return $this->result;
    }

    public function setResult(?Item $result): static
    {
        $this->result = $result;

        return $this;
    }

    public function getResultAmount(): ?int
    {
        return $this->resultAmount;
    }

    public function setResultAmount(int $resultAmount): static
    {
        $this->resultAmount = $resultAmount;

        return $this;
    }

    /**
     * @return Collection<int, CraftSlot>
     */
    public function getCraftSlots(): Collection
    {
        return $this->craftSlots;
    }

    public function addCraftSlot(CraftSlot $craftSlot): static
    {
        if (!$this->craftSlots->contains($craftSlot)) {
            $this->craftSlots->add($craftSlot);
            $craftSlot->setCraft($this);
        }

        return $this;
    }

    public function removeCraftSlot(CraftSlot $craftSlot): static
    {
        if ($this->craftSlots->removeElement($craftSlot)) {
            // set the owning side to null (unless already changed)
            if ($craftSlot->getCraft() === $this) {
                $craftSlot->setCraft(null);
            }
        }

        return $this;
    }
}
