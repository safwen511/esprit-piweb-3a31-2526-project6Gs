<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity(fields: ['email'], message: 'profile_page.validation.email_taken')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(message: 'profile_page.validation.email_required')]
    #[Assert\Email(message: 'profile_page.validation.email_invalid')]
    private ?string $email = null;

    /**
     * @var list<string>
     */
    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 120)]
    #[Assert\NotBlank(message: 'profile_page.validation.first_name_required')]
    #[Assert\Length(
        min: 2,
        max: 120,
        minMessage: 'profile_page.validation.first_name_min',
        maxMessage: 'profile_page.validation.first_name_max',
    )]
    #[Assert\Regex(
        pattern: "/^[\p{L}\s'-]+$/u",
        message: 'profile_page.validation.first_name_format',
    )]
    private ?string $firstName = null;

    #[ORM\Column(length: 120)]
    #[Assert\NotBlank(message: 'profile_page.validation.last_name_required')]
    #[Assert\Length(
        min: 2,
        max: 120,
        minMessage: 'profile_page.validation.last_name_min',
        maxMessage: 'profile_page.validation.last_name_max',
    )]
    #[Assert\Regex(
        pattern: "/^[\p{L}\s'-]+$/u",
        message: 'profile_page.validation.last_name_format',
    )]
    private ?string $lastName = null;

    #[ORM\Column(length: 30, nullable: true)]
    #[Assert\Length(max: 30, maxMessage: 'profile_page.validation.phone_max')]
    #[Assert\Regex(
        pattern: '/^\+?[0-9\s().-]{7,30}$/',
        message: 'profile_page.validation.phone_invalid',
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

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Produit::class)]
    private Collection $produits;

    /**
     * @var Collection<int, ResetPasswordRequest>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ResetPasswordRequest::class, orphanRemoval: true)]
    private Collection $resetPasswordRequests;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $signature = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $voiceSamplePath = null;

    /**
     * @var list<float>|null
     */
    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $voiceVector = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $voiceEnrolledAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $voiceLastUsedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $voicePassphrase = null;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->resetPasswordRequests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $email = $email !== null ? trim($email) : null;
        $this->email = $email !== null && $email !== '' ? mb_strtolower($email) : null;

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

    public function hasRole(string $role): bool
    {
        return in_array($role, $this->getRoles(), true);
    }

    public function isOwner(): bool
    {
        return $this->hasRole('ROLE_ADMIN') || $this->hasRole('ROLE_OWNER');
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

    public function setFirstName(?string $firstName): static
    {
        $firstName = $firstName !== null ? trim($firstName) : null;
        $this->firstName = $firstName !== null && $firstName !== '' ? $firstName : null;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $lastName = $lastName !== null ? trim($lastName) : null;
        $this->lastName = $lastName !== null && $lastName !== '' ? $lastName : null;

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

    public function getAccountStatusLabel(): string
    {
        return $this->isActive ? 'Active' : 'Inactive';
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

    public function getVeterinaryRequestStatusLabel(): string
    {
        if ($this->isVeteranApproved) {
            return 'Approved';
        }

        if ($this->isVeteranApplicant) {
            return 'Pending review';
        }

        return 'No request';
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

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setOwner($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit) && $produit->getOwner() === $this) {
            $produit->setOwner(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, ResetPasswordRequest>
     */
    public function getResetPasswordRequests(): Collection
    {
        return $this->resetPasswordRequests;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSignature(): ?string
    {
        return $this->signature;
    }

    public function setSignature(?string $signature): static
    {
        $this->signature = $signature;

        return $this;
    }

    public function getVoiceSamplePath(): ?string
    {
        return $this->voiceSamplePath;
    }

    public function setVoiceSamplePath(?string $voiceSamplePath): static
    {
        $this->voiceSamplePath = $voiceSamplePath ? trim($voiceSamplePath) : null;

        return $this;
    }

    /**
     * @return list<float>
     */
    public function getVoiceVector(): array
    {
        return $this->voiceVector !== null ? array_map('floatval', $this->voiceVector) : [];
    }

    /**
     * @param list<float>|null $voiceVector
     */
    public function setVoiceVector(?array $voiceVector): static
    {
        $this->voiceVector = $voiceVector !== null ? array_map('floatval', $voiceVector) : null;

        return $this;
    }

    public function getVoiceEnrolledAt(): ?\DateTimeImmutable
    {
        return $this->voiceEnrolledAt;
    }

    public function setVoiceEnrolledAt(?\DateTimeImmutable $voiceEnrolledAt): static
    {
        $this->voiceEnrolledAt = $voiceEnrolledAt;

        return $this;
    }

    public function getVoiceLastUsedAt(): ?\DateTimeImmutable
    {
        return $this->voiceLastUsedAt;
    }

    public function hasVoiceEnrollment(): bool
    {
        return ($this->voicePassphrase !== null && trim($this->voicePassphrase) !== '')
            || (
                $this->voiceSamplePath !== null
                && $this->voiceSamplePath !== ''
                && $this->getVoiceVector() !== []
            );
    }

    public function touchVoiceLastUsedAt(): static
    {
        $this->voiceLastUsedAt = new \DateTimeImmutable();

        return $this;
    }

    public function getVoicePassphrase(): ?string
    {
        return $this->voicePassphrase;
    }

    public function setVoicePassphrase(?string $voicePassphrase): static
    {
        $voicePassphrase = $voicePassphrase !== null ? trim($voicePassphrase) : null;
        $this->voicePassphrase = $voicePassphrase !== '' ? $voicePassphrase : null;

        return $this;
    }
}
