<?php
// src/Entity/Review.php
namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[ORM\Table(name: 'review')]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'vet_id', referencedColumnName: 'id', nullable: false)]
    private ?User $vet = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false)]
    private ?User $client = null;

    #[ORM\Column(type: 'integer')] // 1 à 5
    private ?int $note = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    public function getId(): ?int { return $this->id; }
    public function getVet(): ?User { return $this->vet; }
    public function setVet(?User $v): self { $this->vet = $v; return $this; }
    public function getClient(): ?User { return $this->client; }
    public function setClient(?User $v): self { $this->client = $v; return $this; }
    public function getNote(): ?int { return $this->note; }
    public function setNote(int $v): self { $this->note = $v; return $this; }
    public function getCommentaire(): ?string { return $this->commentaire; }
    public function setCommentaire(?string $v): self { $this->commentaire = $v; return $this; }
    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $v): self { $this->createdAt = $v; return $this; }
}