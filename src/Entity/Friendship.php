<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\FriendshipRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendshipRepository::class)]
#[ORM\Table(name: 'friendship')]
#[ORM\Index(name: 'fk_fs_u2', columns: ['user2_id'])]
#[ORM\UniqueConstraint(name: 'uq_friendship', columns: ['user1_id', 'user2_id'])]
class Friendship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: Types::BIGINT)]
    private ?int $id = null;

    #[ORM\Column(name: 'user1_id', type: Types::INTEGER)]
    private int $user1Id;

    #[ORM\Column(name: 'user2_id', type: Types::INTEGER)]
    private int $user2Id;

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function setId(?int $id): self
    {
        $this->id = $id;
    
        return $this;
    }

    public function getUser1Id(): int
    {
        return $this->user1Id;
    }
    
    public function setUser1Id(int $user1Id): self
    {
        $this->user1Id = $user1Id;
    
        return $this;
    }

    public function getUser2Id(): int
    {
        return $this->user2Id;
    }
    
    public function setUser2Id(int $user2Id): self
    {
        $this->user2Id = $user2Id;
    
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
    
    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }
}
