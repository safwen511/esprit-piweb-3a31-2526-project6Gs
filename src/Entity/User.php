<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: 'user')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    #[ORM\Column(name: 'first_name', length: 100)]
    private ?string $firstName = null;

    #[ORM\Column(name: 'last_name', length: 100)]
    private ?string $lastName = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $role = null;

    #[ORM\Column(length: 20, nullable: true)]
private ?string $phone = null;
    #[ORM\Column(type: 'text', nullable: true)]
private ?string $signature = null;


    #[ORM\Column(length: 180, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $password = null;

    public function getId(): ?int { return $this->id; }
    public function getFirstName(): ?string { return $this->firstName; }
    public function setFirstName(string $v): self { $this->firstName = $v; return $this; }
    public function getLastName(): ?string { return $this->lastName; }
    public function setLastName(string $v): self { $this->lastName = $v; return $this; }
    public function getRole(): ?string { return $this->role; }
    public function setRole(?string $v): self { $this->role = $v; return $this; }
    public function getPhone(): ?string { return $this->phone; }
public function setPhone(?string $v): self { $this->phone = $v; return $this; }
    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $v): self { $this->email = $v; return $this; }
    public function getPassword(): ?string { return $this->password; }
    public function setPassword(?string $v): self { $this->password = $v; return $this; }

    // Méthodes requises par UserInterface
    public function getUserIdentifier(): string { return (string) $this->email; }
public function getRoles(): array 
{ 
    return ['ROLE_' . ($this->role ?? 'CLIENT')]; 
}    public function eraseCredentials(): void {}

public function getSignature(): ?string
{
    return $this->signature;
}

public function setSignature(?string $signature): self
{
    $this->signature = $signature;
    return $this;
}
}