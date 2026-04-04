<?php

namespace App\Entity;

use App\Repository\AdoptionRequestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AdoptionRequestRepository::class)]
#[ORM\Table(name: 'adoption_request')]
class AdoptionRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotNull(message: 'Request date cannot be blank.')]
    #[Assert\Type(type: '\\DateTimeInterface', message: 'Request date must be a valid date and time.')]
    private ?\DateTimeInterface $requestDate = null;

    #[ORM\Column(type: Types::STRING, length: 20)]
    #[Assert\NotNull(message: 'Status must be set.')]
    private ?string $status = null;

    #[ORM\ManyToOne(targetEntity: Animal::class)]
    #[ORM\JoinColumn(name: 'animal_id', referencedColumnName: 'idAnimal', nullable: false)]
    #[Assert\NotNull(message: 'An animal must be selected.')]
    private ?Animal $animal = null;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\NotNull(message: 'Client ID is required.')]
    #[Assert\Positive(message: 'Client ID must be a positive integer.')]
    private ?int $clientId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequestDate(): ?\DateTimeInterface
    {
        return $this->requestDate;
    }

    public function setRequestDate(\DateTimeInterface $requestDate): self
    {
        $this->requestDate = $requestDate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function setClientId(int $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }
}
