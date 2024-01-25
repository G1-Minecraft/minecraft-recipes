<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CraftSlotRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CraftSlotRepository::class)]
#[ApiResource(normalizationContext: ["groups"=>["singleCraftSlot:read", "craftSlot:read", "item:read"]])]
class CraftSlot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['craftSlot:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'craftSlots')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['singleCraftSlot:read'])]
    private ?Craft $craft = null;

    #[ORM\ManyToOne(fetch: 'EAGER', inversedBy: 'craftSlots')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['craftSlot:read'])]
    private ?Item $item = null;

    #[ORM\Column]
    #[Groups(['craftSlot:read'])]
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
