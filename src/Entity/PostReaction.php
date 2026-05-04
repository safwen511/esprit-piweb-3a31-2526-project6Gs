<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PostReactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostReactionRepository::class)]
#[ORM\Table(name: 'post_reaction')]
#[ORM\UniqueConstraint(name: 'uq_post_user', columns: ['post_id', 'user_id'])]
class PostReaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: Types::BIGINT)]
    private ?int $id = null;

    #[ORM\Column(name: 'post_id', type: Types::BIGINT)]
    private int|string $postId = 0;

    #[ORM\Column(name: 'user_id', type: Types::BIGINT)]
    private int|string $userId = 0;

    #[ORM\Column(name: 'reaction', type: Types::STRING, length: 16)]
    private string $reaction = '';

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

    public function getPostId(): int|string
    {
        return $this->postId;
    }
    
    public function setPostId(int|string $postId): self
    {
        $this->postId = $postId;
    
        return $this;
    }

    public function getUserId(): int|string
    {
        return $this->userId;
    }
    
    public function setUserId(int|string $userId): self
    {
        $this->userId = $userId;
    
        return $this;
    }

    public function getReaction(): string
    {
        return $this->reaction;
    }
    
    public function setReaction(string $reaction): self
    {
        $this->reaction = $reaction;
    
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
