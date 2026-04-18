<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CommentReactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentReactionRepository::class)]
#[ORM\Table(name: 'comment_reaction')]
class CommentReaction
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Comment::class)]
    #[ORM\JoinColumn(name: 'comment_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?Comment $comment = null;

    #[ORM\Id]
    #[ORM\Column(name: 'user_id', type: Types::BIGINT)]
    private ?int $userId = null;

    #[ORM\Column(name: 'reaction', type: Types::STRING, length: 16)]
    private ?string $reaction = null;

    public function getComment(): ?Comment
    {
        return $this->comment;
    }
    
    public function setComment(?Comment $comment): self
    {
        $this->comment = $comment;
    
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

    public function getReaction(): ?string
    {
        return $this->reaction;
    }
    
    public function setReaction(?string $reaction): self
    {
        $this->reaction = $reaction;
    
        return $this;
    }
}