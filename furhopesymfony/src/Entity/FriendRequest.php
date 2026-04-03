<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\FriendRequestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendRequestRepository::class)]
#[ORM\Table(name: 'friend_request')]
#[ORM\Index(name: 'fk_fr_receiver', columns: ['receiver_id'])]
#[ORM\UniqueConstraint(name: 'uq_request', columns: ['sender_id', 'receiver_id'])]
class FriendRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: Types::BIGINT)]
    private ?int $id = null;

    #[ORM\Column(name: 'sender_id', type: Types::INTEGER)]
    private ?int $senderId = null;

    #[ORM\Column(name: 'receiver_id', type: Types::INTEGER)]
    private ?int $receiverId = null;

    #[ORM\Column(name: 'status', type: Types::STRING, length: 16, options: ['default' => 'PENDING'])]
    private ?string $status = 'PENDING';

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function setId(?int $id): self
    {
        $this->id = $id;
    
        return $this;
    }

    public function getSenderId(): ?int
    {
        return $this->senderId;
    }
    
    public function setSenderId(?int $senderId): self
    {
        $this->senderId = $senderId;
    
        return $this;
    }

    public function getReceiverId(): ?int
    {
        return $this->receiverId;
    }
    
    public function setReceiverId(?int $receiverId): self
    {
        $this->receiverId = $receiverId;
    
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }
    
    public function setStatus(?string $status): self
    {
        $this->status = $status;
    
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }
    
    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }
}