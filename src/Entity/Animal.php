<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[ORM\Table(name: 'animal')]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idAnimal', type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 100)]
    #[Assert\NotBlank(message: 'Name should not be blank.')]
    #[Assert\Length(max: 100, maxMessage: 'Name cannot be longer than {{ limit }} characters.')]
    private ?string $name = null;

    #[ORM\Column(name: 'species', type: Types::STRING, length: 50)]
    #[Assert\NotBlank(message: 'Species should not be blank.')]
    #[Assert\Length(max: 50, maxMessage: 'Species cannot be longer than {{ limit }} characters.')]
    private ?string $type = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $breed = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    #[Assert\NotNull(message: 'Age should not be blank.')]
    #[Assert\Positive(message: 'Age must be a positive number.')]
    private ?int $age = null;

    #[ORM\Column(type: Types::STRING, length: 10, nullable: true)]
    private ?string $gender = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::STRING, length: 20)]
    private ?string $status = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    #[Assert\Regex(
        pattern: '/\.(?:jpe?g|png)$/i',
        message: 'The image path must end with .jpg, .jpeg, or .png.',
        match: true
    )]
    private ?string $image = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'animals')]
    #[ORM\JoinColumn(name: 'owner_compte_id', referencedColumnName: 'id', nullable: true)]
    private ?User $owner = null;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getBreed(): ?string
    {
        return $this->breed;
    }

    public function setBreed(?string $breed): self
    {
        $this->breed = $breed;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getAgeValueInput(): ?int
    {
        if ($this->age === null) {
            return null;
        }

        if ($this->age >= 12 && $this->age % 12 === 0) {
            return (int) ($this->age / 12);
        }

        return $this->age;
    }

    public function getAgeUnitInput(): string
    {
        if ($this->age !== null && $this->age >= 12 && $this->age % 12 === 0) {
            return 'years';
        }

        return 'months';
    }

    public function getFormattedAge(): ?string
    {
        if ($this->age === null || $this->age <= 0) {
            return null;
        }

        if ($this->age < 12) {
            return $this->age . ' ' . ($this->age === 1 ? 'month' : 'months');
        }

        $years = intdiv($this->age, 12);
        $months = $this->age % 12;
        $parts = [];

        if ($years > 0) {
            $parts[] = $years . ' ' . ($years === 1 ? 'year' : 'years');
        }

        if ($months > 0) {
            $parts[] = $months . ' ' . ($months === 1 ? 'month' : 'months');
        }

        return implode(' ', $parts);
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
