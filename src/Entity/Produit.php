<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ORM\Table(name: 'produit')]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

<<<<<<< HEAD
    #[ORM\Column(length: 50, options: ['default' => 'medical'])]
=======
    #[ORM\Column(length: 50)]
>>>>>>> origin/integrationv11
    private ?string $category = 'medical';

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?float $tva = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

<<<<<<< HEAD
    #[ORM\Column(type: 'text', nullable: true)]
=======
    #[ORM\Column(type: 'text', nullable: true, columnDefinition: 'TEXT DEFAULT NULL')]
>>>>>>> origin/integrationv11
    private ?string $description = null;

    #[ORM\Column]
    private ?int $stock = null;

<<<<<<< HEAD
    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?User $owner = null;

=======
>>>>>>> origin/integrationv11
    /**
     * @var Collection<int, Panier>
     */
    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Panier::class)]
    private Collection $paniers;

    public function __construct()
    {
        $this->paniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
<<<<<<< HEAD
        $this->title = trim($title);
=======
        $this->title = $title;
>>>>>>> origin/integrationv11

        return $this;
    }

<<<<<<< HEAD
    public function getCategory(): string
    {
        return $this->category ?? 'medical';
    }

    public function setCategory(string $category): static
    {
        $normalized = strtolower(trim($category));
        if (!array_key_exists($normalized, self::allowedCategories())) {
            $normalized = 'medical';
        }

        $this->category = $normalized;

        return $this;
    }

    /**
     * @return array<string, string>
     */
    public static function allowedCategories(): array
    {
        return [
            'medical' => 'Medical',
            'clothing' => 'Clothing',
            'toys' => 'Toys',
            'food' => 'Food',
        ];
    }

    public function getCategoryLabel(): string
    {
        $categories = self::allowedCategories();

        return $categories[$this->getCategory()] ?? ucfirst($this->getCategory());
    }

=======
>>>>>>> origin/integrationv11
    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(float $tva): static
    {
        $this->tva = $tva;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
<<<<<<< HEAD
        $this->image = $image !== null ? trim($image) : null;
=======
        $this->image = $image;
>>>>>>> origin/integrationv11

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
<<<<<<< HEAD
        $this->description = $description !== null ? trim($description) : null;
=======
        $this->description = $description;
>>>>>>> origin/integrationv11

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

<<<<<<< HEAD
    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;
=======
    /**
     * @return array<string, string>
     */
    public static function allowedCategories(): array
    {
        return [
            'medical' => 'Medical',
            'clothing' => 'Clothing',
            'toys' => 'Toys',
            'food' => 'Food',
        ];
    }

    public function getCategory(): string
    {
        return $this->category ?? 'medical';
    }

    public function getCategoryLabel(): string
    {
        $categories = self::allowedCategories();

        return $categories[$this->getCategory()] ?? ucfirst($this->getCategory());
    }

    public function setCategory(string $category): static
    {
        $normalized = strtolower(trim($category));
        if (!array_key_exists($normalized, self::allowedCategories())) {
            $normalized = 'medical';
        }

        $this->category = $normalized;
>>>>>>> origin/integrationv11

        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): static
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers->add($panier);
            $panier->setProduit($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): static
    {
        if ($this->paniers->removeElement($panier) && $panier->getProduit() === $this) {
            $panier->setProduit(null);
        }

        return $this;
    }
}
