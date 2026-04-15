<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'disponibilite')]
class Disponibilite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_disponibilite')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'vet_id', referencedColumnName: 'id')]
    private ?User $vet = null;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank(message: "La date est obligatoire")]
    private ?\DateTime $date = null;

    #[ORM\Column(type: 'time')]
    #[Assert\NotBlank(message: "L'heure de début est obligatoire")]
    private ?\DateTime $startTime = null;

    #[ORM\Column(type: 'time')]
    #[Assert\NotBlank(message: "L'heure de fin est obligatoire")]
    private ?\DateTime $endTime = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isAvailable = true;

    public function getId(): ?int { return $this->id; }
    public function getVet(): ?User { return $this->vet; }
    public function setVet(?User $vet): self { $this->vet = $vet; return $this; }
    public function getDate(): ?\DateTime { return $this->date; }
    public function setDate(\DateTime $d): self { $this->date = $d; return $this; }
    public function getStartTime(): ?\DateTime { return $this->startTime; }
    public function setStartTime(\DateTime $t): self { $this->startTime = $t; return $this; }
    public function getEndTime(): ?\DateTime { return $this->endTime; }
    public function setEndTime(\DateTime $t): self { $this->endTime = $t; return $this; }
    public function isAvailable(): bool { return $this->isAvailable; }
    public function setIsAvailable(bool $v): self { $this->isAvailable = $v; return $this; }

    #[Assert\IsTrue(message: "L'heure de fin doit être après l'heure de début")]
    public function isEndTimeAfterStartTime(): bool
    {
        if (!$this->startTime || !$this->endTime) return true;
        return $this->endTime > $this->startTime;
    }

}