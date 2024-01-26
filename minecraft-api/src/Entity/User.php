<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\UserRepository;
use App\State\UserProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity("login", message: "Login must be unique!")]
#[UniqueEntity("email", message: "Email must be unique!")]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(operations: [
        new Get(),
        new GetCollection(),
        new Post(
            denormalizationContext: ['groups'=>['user:create']],
            validationContext: ['groups'=>['Default', 'user:create']],
            processor: UserProcessor::class),
        new Patch(
            denormalizationContext: ['groups'=>['user:update']],
            security: "is_granted('ROLE_USER') and object == user",
            validationContext: ['groups'=>['Default', 'user:update']],
            processor: UserProcessor::class),
        new Delete(security: "is_granted('ROLE_USER') and object == user")],
    normalizationContext: ["groups"=>["user:read"]])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:read'])]
    private ?int $id = null;

    #[Assert\NotBlank(groups: ['user:create'])]
    #[Assert\NotNull(groups: ['user:create'])]
    #[Assert\Length(min: 4, max: 20, minMessage: 'Must be 4 characters or more!', maxMessage: 'Must be 20 characters or less!')]
    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['user:read', 'user:create'])]
    private ?string $login = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[Assert\NotBlank(groups: ['user:create'])]
    #[Assert\NotNull(groups: ['user:create'])]
    #[Assert\Email(message: "Invalid email!")]
    #[ORM\Column(length: 255, unique: true)]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'creator', targetEntity: Item::class, orphanRemoval: true)]
    private Collection $items;

    #[ORM\OneToMany(mappedBy: 'creator', targetEntity: Craft::class, orphanRemoval: true)]
    private Collection $crafts;

    #[Assert\NotBlank(groups: ['user:create'])]
    #[Assert\NotNull(groups: ['user:create'])]
    #[Assert\Length(min: 8, max: 30, minMessage: 'Must be 8 characters or more!', maxMessage: 'Must be 20 characters or less!')]
    #[Assert\Regex(pattern: '#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,30}$#', message: 'Must contain a number, an uppercase letter and a lowercase letter!')]
    #[ApiProperty(readable: false)]
    #[Groups(['user:create', 'user:update'])]
    private ?string $plainPassword = null;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->crafts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setCreator($this);
        }

        return $this;
    }

    public function removeItem(Item $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getCreator() === $this) {
                $item->setCreator(null);
            }
        }

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
            $craft->setCreator($this);
        }

        return $this;
    }

    public function removeCraft(Craft $craft): static
    {
        if ($this->crafts->removeElement($craft)) {
            // set the owning side to null (unless already changed)
            if ($craft->getCreator() === $this) {
                $craft->setCreator(null);
            }
        }

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }
}
