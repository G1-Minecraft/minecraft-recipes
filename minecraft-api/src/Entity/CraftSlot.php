<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CraftSlotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CraftSlotRepository::class)]
#[ApiResource]
class CraftSlot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'craftSlots')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Craft $craft = null;

    #[ORM\ManyToOne(inversedBy: 'craftSlots')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Item $item = null;

    #[ORM\Column]
    private ?int $position = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCraft(): ?Craft
    {
        return $this->craft;
    }

    public function setCraft(?Craft $craft): static
    {
        $this->craft = $craft;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): static
    {
        $this->item = $item;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }
}
