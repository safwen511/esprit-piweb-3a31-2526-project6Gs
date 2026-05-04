<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ORM\Table(name: 'reservation')]
#[ORM\Index(name: 'fk_reservation_client', columns: ['client_id'])]
#[ORM\Index(name: 'fk_reservation_animal', columns: ['animal_id'])]
#[ORM\Index(name: 'fk_reservation_hotel', columns: ['hotel_id'])]
#[ORM\HasLifecycleCallbacks]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
    private ?User $client = null;

    #[ORM\ManyToOne(targetEntity: Animal::class)]
    #[ORM\JoinColumn(name: 'animal_id', referencedColumnName: 'idAnimal', nullable: true, onDelete: 'CASCADE')]
    private ?Animal $animal = null;

    #[ORM\ManyToOne(targetEntity: Hotel::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(name: 'hotel_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
    private ?Hotel $hotel = null;

    #[ORM\Column(name: 'start_date', type: Types::DATE_MUTABLE)]
    private \DateTimeInterface $startDate;

    #[ORM\Column(name: 'end_date', type: Types::DATE_MUTABLE)]
    private \DateTimeInterface $endDate;

    #[ORM\Column(type: Types::STRING, length: 16)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 16)]
    private string $status = 'PENDING';

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(name: 'reservation_date', type: Types::DATE_MUTABLE)]
    private \DateTimeInterface $reservationDate;

    #[ORM\Column(name: 'guest_count', type: Types::INTEGER)]
    #[Assert\Positive]
    private int $guestCount = 1;

    #[ORM\Column(name: 'nightly_rate', type: Types::DECIMAL, precision: 10, scale: 2)]
    private string $nightlyRate = '85.00';

    #[ORM\Column(name: 'total_price', type: Types::DECIMAL, precision: 10, scale: 2)]
    private string $totalPrice = '85.00';

    #[ORM\Column(name: 'qr_code_path', type: Types::STRING, length: 255, nullable: true)]
    private ?string $qrCodePath = null;

    #[ORM\Column(name: 'qr_code_generated_at', type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $qrCodeGeneratedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->client?->getId();
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function getAnimalId(): ?int
    {
        return $this->animal?->getId();
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): static
    {
        $this->hotel = $hotel;

        return $this;
    }

    public function getStartDate(): \DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): \DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = strtoupper(trim($status));

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getReservationDate(): \DateTimeInterface
    {
        return $this->reservationDate;
    }

    public function setReservationDate(\DateTimeInterface $reservationDate): static
    {
        $this->reservationDate = $reservationDate;

        return $this;
    }

    public function getGuestCount(): int
    {
        return $this->guestCount;
    }

    public function setGuestCount(int $guestCount): static
    {
        $this->guestCount = max(1, $guestCount);

        return $this;
    }

    public function getNightlyRate(): string
    {
        return $this->nightlyRate;
    }

    public function setNightlyRate(string $nightlyRate): static
    {
        $this->nightlyRate = $nightlyRate;

        return $this;
    }

    public function getTotalPrice(): string
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(string $totalPrice): static
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getQrCodePath(): ?string
    {
        return $this->qrCodePath;
    }

    public function setQrCodePath(?string $qrCodePath): static
    {
        $this->qrCodePath = $qrCodePath !== null ? trim($qrCodePath) : null;

        return $this;
    }

    public function getQrCodeGeneratedAt(): ?\DateTimeImmutable
    {
        return $this->qrCodeGeneratedAt;
    }

    public function setQrCodeGeneratedAt(?\DateTimeImmutable $qrCodeGeneratedAt): static
    {
        $this->qrCodeGeneratedAt = $qrCodeGeneratedAt;

        return $this;
    }

    public function hasQrCode(): bool
    {
        return $this->qrCodePath !== null && $this->qrCodePath !== '';
    }

    public function getStatusLabel(): string
    {
        return ucfirst(strtolower($this->status));
    }

    #[ORM\PrePersist]
    public function initializeDates(): void
    {
        $this->createdAt ??= new \DateTime();
        $this->reservationDate ??= new \DateTime('today');
    }
}
