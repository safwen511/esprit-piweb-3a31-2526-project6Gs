<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Shopges\Produit;
use App\Repository\UserRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'user')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'first_name', length: 100)]
    private ?string $firstName = null;

    #[ORM\Column(name: 'last_name', length: 100)]
    private ?string $lastName = null;

    #[ORM\Column(length: 150)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $role = null;

    #[ORM\Column(nullable: true)]
    private ?bool $active = true;

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $createdAt = null;

    #[ORM\Column(name: 'id_user', nullable: true)]
    private ?int $idUser = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(name: 'profile_image_path', length: 1024, nullable: true)]
    private ?string $profileImagePath = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): string
    {
        return strtoupper((string) $this->role);
    }

    public function getName(): string
    {
        $name = trim((string) $this->name);
        if ($name !== '') {
            return $name;
        }

        return trim((string) $this->firstName . ' ' . (string) $this->lastName);
    }

    public function isOwner(): bool
    {
        return in_array($this->getRole(), ['ADMIN', 'OWNER'], true);
    }
}
