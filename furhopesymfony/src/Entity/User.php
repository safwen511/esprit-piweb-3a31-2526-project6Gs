<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity(fields: ['email'], message: 'An account already exists with this email address.')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    /**
     * @var list<string>
     */
    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 120)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 120)]
    #[Assert\Regex(
        pattern: "/^[\p{L}\s'-]+$/u",
        message: 'First name can only contain letters, spaces, apostrophes, and hyphens.',
    )]
    private ?string $firstName = null;

    #[ORM\Column(length: 120)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 120)]
    #[Assert\Regex(
        pattern: "/^[\p{L}\s'-]+$/u",
        message: 'Last name can only contain letters, spaces, apostrophes, and hyphens.',
    )]
    private ?string $lastName = null;

    #[ORM\Column(length: 30, nullable: true)]
    #[Assert\Length(max: 30)]
    #[Assert\Regex(
        pattern: '/^\+?[0-9\s().-]{7,30}$/',
        message: 'Enter a valid phone number.',
    )]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    private ?string $profileImageUrl = null;

    #[ORM\Column]
    private bool $isVerified = false;

    #[ORM\Column]
    private bool $isActive = true;

    #[ORM\Column]
    private bool $isVeteranApplicant = false;

    #[ORM\Column]
    private bool $isVeteranApproved = false;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = mb_strtolower(trim($email));

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_values(array_unique($roles));
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials(): void
    {
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = trim($firstName);

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = trim($lastName);

        return $this;
    }

    public function getFullName(): string
    {
        return trim(sprintf('%s %s', $this->firstName, $this->lastName));
    }

    public function getName(): ?string
    {
        $fullName = $this->getFullName();

        return $fullName !== '' ? $fullName : $this->email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $phoneNumber = $phoneNumber !== null ? trim($phoneNumber) : null;
        $this->phoneNumber = $phoneNumber !== '' ? $phoneNumber : null;

        return $this;
    }

    public function getProfileImageUrl(): ?string
    {
        return $this->profileImageUrl;
    }

    public function setProfileImageUrl(?string $profileImageUrl): static
    {
        $this->profileImageUrl = $profileImageUrl ? trim($profileImageUrl) : null;

        return $this;
    }

    public function getProfileImagePath(): ?string
    {
        if (!$this->profileImageUrl) {
            return null;
        }

        // Ignore Windows local filesystem paths imported from legacy dumps.
        if (preg_match('/^[A-Za-z]:\\\\/', $this->profileImageUrl) === 1) {
            return null;
        }

        if (str_starts_with($this->profileImageUrl, 'http://') || str_starts_with($this->profileImageUrl, 'https://')) {
            return $this->profileImageUrl;
        }

        return '/'.$this->profileImageUrl;
    }

    public function getInitials(): string
    {
        $first = $this->firstName ? mb_substr($this->firstName, 0, 1) : '';
        $last = $this->lastName ? mb_substr($this->lastName, 0, 1) : '';

        return mb_strtoupper(trim($first.$last));
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function isVeteranApplicant(): bool
    {
        return $this->isVeteranApplicant;
    }

    public function setIsVeteranApplicant(bool $isVeteranApplicant): static
    {
        $this->isVeteranApplicant = $isVeteranApplicant;

        return $this;
    }

    public function isVeteranApproved(): bool
    {
        return $this->isVeteranApproved;
    }

    public function setIsVeteranApproved(bool $isVeteranApproved): static
    {
        $this->isVeteranApproved = $isVeteranApproved;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCreatedAtLabel(): string
    {
        return $this->createdAt?->format('Y-m-d H:i') ?? '';
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getUpdatedAtLabel(): string
    {
        return $this->updatedAt?->format('Y-m-d H:i') ?? '';
    }

    #[ORM\PrePersist]
    public function setCreatedTimestamps(): void
    {
        $now = new \DateTimeImmutable();
        $this->createdAt ??= $now;
        $this->updatedAt = $now;
    }

    #[ORM\PreUpdate]
    public function setUpdatedTimestamp(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
}
