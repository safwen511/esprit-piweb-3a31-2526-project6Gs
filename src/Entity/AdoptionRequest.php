<?php

declare(strict_types=1);

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
    #[Assert\NotNull(message: 'validation.request.date_required')]
    #[Assert\Type(type: \DateTimeInterface::class, message: 'validation.request.date_invalid')]
    #[Assert\LessThanOrEqual('now', message: 'validation.request.date_future')]
    private \DateTimeInterface $requestDate;

    #[ORM\Column(type: Types::STRING, length: 20)]
    #[Assert\NotBlank(message: 'validation.request.status_required')]
    #[Assert\Choice(choices: ['PENDING', 'APPROVED', 'REJECTED'], message: 'validation.request.status_choice')]
    private string $status = 'PENDING';

    #[ORM\ManyToOne(targetEntity: Animal::class)]
    #[ORM\JoinColumn(name: 'animal_id', referencedColumnName: 'idAnimal', nullable: false)]
    #[Assert\NotNull(message: 'validation.request.animal_required')]
    private Animal $animal;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\NotNull(message: 'validation.request.client_required')]
    #[Assert\Positive(message: 'validation.request.client_positive')]
    private int $clientId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequestDate(): \DateTimeInterface
    {
        return $this->requestDate;
    }

    public function setRequestDate(\DateTimeInterface $requestDate): self
    {
        $this->requestDate = $requestDate;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAnimal(): Animal
    {
        return $this->animal;
    }

    public function setAnimal(Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function setClientId(int $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }
}
