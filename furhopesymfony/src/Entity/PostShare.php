<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PostShareRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostShareRepository::class)]
#[ORM\Table(name: 'post_share')]
#[ORM\UniqueConstraint(name: 'uq_post_user_share', columns: ['post_id', 'user_id'])]
class PostShare
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: Types::BIGINT)]
    private ?int $id = null;

    #[ORM\Column(name: 'post_id', type: Types::BIGINT)]
    private ?int $postId = null;

    #[ORM\Column(name: 'user_id', type: Types::BIGINT)]
    private ?int $userId = null;

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

    public function getPostId(): ?int
    {
        return $this->postId;
    }
    
    public function setPostId(?int $postId): self
    {
        $this->postId = $postId;
    
        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }
    
    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;
    
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