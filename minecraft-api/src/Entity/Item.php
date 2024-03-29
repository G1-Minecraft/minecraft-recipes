<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\UploadTextureController;
use App\Repository\ItemRepository;
use App\State\CreatorProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[ApiResource(operations: [
    new GetCollection(),
    new Get(),
    new Post(denormalizationContext: ['groups'=>['item:create']], security: "is_granted('ROLE_USER')", processor: CreatorProcessor::class),
    new Delete(security: "is_granted('ROLE_ADMIN') or (is_granted('ROLE_USER') and object.getCreator() == user)"),
    new Post(uriTemplate: "/items/{id}/upload_texture", controller: UploadTextureController::class, deserialize: false)
], normalizationContext: ["groups"=>["item:read"]])]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['item:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['item:read', 'item:create'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['item:read', 'item:create'])]
    private ?string $textureName = null;

    #[ORM\OneToMany(mappedBy: 'result', targetEntity: Craft::class, orphanRemoval: true)]
    private Collection $crafts;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: CraftSlot::class, orphanRemoval: true)]
    private Collection $craftSlots;

    #[ORM\ManyToOne(fetch: 'EAGER', inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    #[ApiProperty(writable: false)]
    #[Groups(['item:read'])]
    private ?User $creator = null;

    public function __construct()
    {
        $this->crafts = new ArrayCollection();
        $this->craftSlots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTextureName(): ?string
    {
        return $this->textureName;
    }

    public function setTextureName(?string $textureName): static
    {
        $this->textureName = $textureName;

        return $this;
    }

    /**
     * @return Collection<int, Craft>
     */
    public function getCrafts(): Collection
    {
        return $this->crafts;
    }

    public function addCraft(Craft $craft): static
    {
        if (!$this->crafts->contains($craft)) {
            $this->crafts->add($craft);
            $craft->setResult($this);
        }

        return $this;
    }

    public function removeCraft(Craft $craft): static
    {
        if ($this->crafts->removeElement($craft)) {
            // set the owning side to null (unless already changed)
            if ($craft->getResult() === $this) {
                $craft->setResult(null);
            }
        }

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
            $craftSlot->setItem($this);
        }

        return $this;
    }

    public function removeCraftSlot(CraftSlot $craftSlot): static
    {
        if ($this->craftSlots->removeElement($craftSlot)) {
            // set the owning side to null (unless already changed)
            if ($craftSlot->getItem() === $this) {
                $craftSlot->setItem(null);
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
