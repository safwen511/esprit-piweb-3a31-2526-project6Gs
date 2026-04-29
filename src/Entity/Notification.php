<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
#[ORM\Table(name: 'notification')]
#[ORM\Index(name: 'idx_recipient_read_time', columns: ['recipient_id', 'is_read', 'created_at'])]
#[ORM\Index(name: 'fk_notif_actor', columns: ['actor_id'])]
#[ORM\Index(name: 'fk_notif_post', columns: ['post_id'])]
#[ORM\Index(name: 'fk_notif_comment', columns: ['comment_id'])]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: Types::BIGINT)]
    private ?int $id = null;

    #[ORM\Column(name: 'recipient_id', type: Types::INTEGER)]
    private int $recipientId = 0;

    #[ORM\Column(name: 'actor_id', type: Types::INTEGER)]
    private int $actorId = 0;

    #[ORM\Column(name: 'type', type: Types::STRING, length: 20)]
    private string $type = '';

    #[ORM\Column(name: 'post_id', type: Types::BIGINT, nullable: true)]
    private ?int $postId = null;

    #[ORM\Column(name: 'comment_id', type: Types::BIGINT, nullable: true)]
    private ?int $commentId = null;

    #[ORM\Column(name: 'message', type: Types::STRING, length: 255, nullable: true)]
    private ?string $message = null;

    #[ORM\Column(name: 'is_read', type: Types::BOOLEAN, options: ['default' => false])]
    private bool $isRead = false;

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

    public function getRecipientId(): int
    {
        return $this->recipientId;
    }
    
    public function setRecipientId(int $recipientId): self
    {
        $this->recipientId = $recipientId;
    
        return $this;
    }

    public function getActorId(): int
    {
        return $this->actorId;
    }
    
    public function setActorId(int $actorId): self
    {
        $this->actorId = $actorId;
    
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }
    
    public function setType(string $type): self
    {
        $this->type = $type;
    
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

    public function getCommentId(): ?int
    {
        return $this->commentId;
    }
    
    public function setCommentId(?int $commentId): self
    {
        $this->commentId = $commentId;
    
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }
    
    public function setMessage(?string $message): self
    {
        $this->message = $message;
    
        return $this;
    }

    public function isRead(): bool
    {
        return $this->isRead;
    }
    
    public function setIsRead(bool $isRead): self
    {
        $this->isRead = $isRead;
    
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
