<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'animal')]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idAnimal')]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $species = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'owner_compte_id', referencedColumnName: 'id', nullable: true)]
    private ?User $ownerCompte = null;

    public function getId(): ?int { return $this->id; }
    public function getName(): ?string { return $this->name; }
    public function setName(string $v): self { $this->name = $v; return $this; }
    public function getSpecies(): ?string { return $this->species; }
    public function setSpecies(string $v): self { $this->species = $v; return $this; }
    public function getOwnerCompte(): ?User { return $this->ownerCompte; }
    public function setOwnerCompte(?User $v): self { $this->ownerCompte = $v; return $this; }
}