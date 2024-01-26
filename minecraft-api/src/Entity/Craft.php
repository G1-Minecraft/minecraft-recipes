<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Repository\CraftRepository;
use App\State\CreatorProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CraftRepository::class)]
#[ApiResource(operations: [
    new GetCollection(),
    new Get(),
    new Post(denormalizationContext: ['groups'=>['craft:create']], security: "is_granted('ROLE_USER')", processor: CreatorProcessor::class),
    new Delete(security: "is_granted('ROLE_USER') and object.getCreator() == user")
], normalizationContext: ["groups"=>["craft:read", "craftSlot:read", "item:read"]])]
class Craft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['craft:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['craft:read', 'craft:create'])]
    private ?string $crafter = null;

    #[ORM\ManyToOne(fetch: 'EAGER', inversedBy: 'crafts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['craft:read', 'craft:create'])]
    private ?Item $result = null;

    #[ORM\Column]
    #[Groups(['craft:read', 'craft:create'])]
    private ?int $resultAmount = null;

    #[ORM\OneToMany(mappedBy: 'craft', targetEntity: CraftSlot::class, orphanRemoval: true)]
    #[Groups(['craft:read'])]
    private Collection $craftSlots;

    #[ORM\ManyToOne(fetch: 'EAGER', inversedBy: 'crafts')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    #[ApiProperty(writable: false)]
    #[Groups(['craft:read'])]
    private ?User $creator = null;

    public function __construct()
    {
        $this->craftSlots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCrafter(): ?string
    {
        return $this->crafter;
    }

    public function setCrafter(string $crafter): static
    {
        $this->crafter = $crafter;

        return $this;
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

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): static
    {
        $this->creator = $creator;

        return $this;
    }
}
