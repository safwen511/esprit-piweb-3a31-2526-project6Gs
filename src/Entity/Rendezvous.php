<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'rendezvous')]
class Rendezvous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_rdv')]
    private ?int $id = null;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank(message: "La date est obligatoire")]
    #[Assert\GreaterThanOrEqual(
        value: 'today',
        message: "La date doit être aujourd'hui ou dans le futur"
    )]
    private \DateTimeInterface $appointmentDate;

    #[ORM\Column(type: 'time')]
    #[Assert\NotBlank(message: "L'heure est obligatoire")]
    private \DateTimeInterface $appointmentTime;

    #[ORM\Column(length: 30)]
    #[Assert\NotBlank(message: "Le statut est obligatoire")]
    #[Assert\Choice(
        choices: ['pending', 'confirmed', 'cancelled'],
        message: "Statut invalide"
    )]
    private string $status = 'pending';

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\Length(
        max: 500,
        maxMessage: "La description ne peut pas dépasser 500 caractères"
    )]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id')]
    #[Assert\NotNull(message: "Le client est obligatoire")]
    private ?User $client = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'vet_id', referencedColumnName: 'id')]
    #[Assert\NotNull(message: "Le vétérinaire est obligatoire")]
    private ?User $vet = null;

    #[ORM\ManyToOne(targetEntity: Animal::class)]
    #[ORM\JoinColumn(name: 'animal_id', referencedColumnName: 'idAnimal')]
    #[Assert\NotNull(message: "L'animal est obligatoire")]
    private ?Animal $animal = null;

    #[ORM\ManyToOne(targetEntity: Disponibilite::class)]
    #[ORM\JoinColumn(name: 'disponibilite_id', referencedColumnName: 'id_disponibilite')]
    #[Assert\NotNull(message: "La disponibilité est obligatoire")]
    private ?Disponibilite $disponibilite = null;

    public function getId(): ?int { return $this->id; }
    public function getAppointmentDate(): ?\DateTimeInterface { return $this->appointmentDate; }
    public function setAppointmentDate(\DateTimeInterface $d): self { $this->appointmentDate = $d; return $this; }
    public function getAppointmentTime(): ?\DateTimeInterface { return $this->appointmentTime; }
    public function setAppointmentTime(\DateTimeInterface $t): self { $this->appointmentTime = $t; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $s): self { $this->status = $s; return $this; }
    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $d): self { $this->description = $d; return $this; }
    public function getClient(): ?User { return $this->client; }
    public function setClient(?User $u): self { $this->client = $u; return $this; }
    public function getVet(): ?User { return $this->vet; }
    public function setVet(?User $u): self { $this->vet = $u; return $this; }
    public function getAnimal(): ?Animal { return $this->animal; }
    public function setAnimal(?Animal $a): self { $this->animal = $a; return $this; }
    public function getDisponibilite(): ?Disponibilite { return $this->disponibilite; }
    public function setDisponibilite(?Disponibilite $d): self { $this->disponibilite = $d; return $this; }
}
