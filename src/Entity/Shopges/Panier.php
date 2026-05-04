<?php

declare(strict_types=1);

namespace App\Entity\Shopges;

use App\Entity\User;
use App\Repository\Shopges\PanierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
#[ORM\Table(name: 'panier')]
#[ORM\Index(name: 'idx_panier_produit', columns: ['idProduit'])]
#[ORM\Index(name: 'idx_panier_client', columns: ['client_id'])]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'paniers')]
    #[ORM\JoinColumn(name: 'idProduit', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private Produit $produit;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private User $client;

    #[ORM\Column(length: 255)]
    private string $title = '';

    #[ORM\Column(name: 'totalP')]
    private float $totalP = 0.0;

    #[ORM\Column]
    private float $totalt = 0.0;

    #[ORM\Column]
    private int $qty = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): Produit
    {
        return $this->produit;
    }

    public function setProduit(Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    public function getClient(): User
    {
        return $this->client;
    }

    public function setClient(User $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->client->getId();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = trim($title);

        return $this;
    }

    public function getTotalP(): float
    {
        return $this->totalP;
    }

    public function setTotalP(float $totalP): static
    {
        $this->totalP = $totalP;

        return $this;
    }

    public function getTotalt(): float
    {
        return $this->totalt;
    }

    public function setTotalt(float $totalt): static
    {
        $this->totalt = $totalt;

        return $this;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function setQty(int $qty): static
    {
        $this->qty = $qty;

        return $this;
    }

    public function getLineTotal(): float
    {
        return (float) $this->totalP - (float) $this->totalt;
    }
}
