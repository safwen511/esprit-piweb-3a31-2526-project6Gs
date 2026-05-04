<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\Table(name: 'post')]
#[ORM\Index(name: 'idx_post_feed', columns: ['created_at'])]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: Types::BIGINT)]
    private ?int $id = null;

    #[ORM\Column(name: 'caption', type: Types::TEXT, nullable: true)]
    private ?string $caption = null;

    #[ORM\Column(name: 'media_type', type: Types::STRING, length: 10, options: ['default' => 'NONE'])]
    private string $mediaType = 'NONE';

    #[ORM\Column(name: 'media_path', type: Types::STRING, length: 500, nullable: true)]
    private ?string $mediaPath = null;

    #[ORM\Column(name: 'thumbnail_path', type: Types::STRING, length: 500, nullable: true)]
    private ?string $thumbnailPath = null;

    #[ORM\Column(name: 'duration_seconds', type: Types::INTEGER, nullable: true)]
    private ?int $durationSeconds = null;

    #[ORM\Column(name: 'likes_count', type: Types::INTEGER, options: ['default' => 0])]
    private int $likesCount = 0;

    #[ORM\Column(name: 'dislikes_count', type: Types::INTEGER, options: ['default' => 0])]
    private int $dislikesCount = 0;

    #[ORM\Column(name: 'shares_count', type: Types::INTEGER, options: ['default' => 0])]
    private int $sharesCount = 0;

    #[ORM\Column(name: 'comments_count', type: Types::INTEGER, options: ['default' => 0])]
    private int $commentsCount = 0;

    #[ORM\Column(name: 'visibility', type: Types::STRING, length: 10, options: ['default' => 'PUBLIC'])]
    private string $visibility = 'PUBLIC';

    #[ORM\Column(name: 'status', type: Types::STRING, length: 10, options: ['default' => 'ACTIVE'])]
    private string $status = 'ACTIVE';

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(name: 'updated_at', type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'author_id', referencedColumnName: 'id', nullable: false)]
    private User $author;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function setId(?int $id): self
    {
        $this->id = $id;
    
        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }
    
    public function setCaption(?string $caption): self
    {
        $this->caption = $caption;
    
        return $this;
    }

    public function getMediaType(): string
    {
        return $this->mediaType;
    }
    
    public function setMediaType(string $mediaType): self
    {
        $this->mediaType = $mediaType;
    
        return $this;
    }

    public function getMediaPath(): ?string
    {
        return $this->mediaPath;
    }
    
    public function setMediaPath(?string $mediaPath): self
    {
        $this->mediaPath = $mediaPath;
    
        return $this;
    }

    public function getThumbnailPath(): ?string
    {
        return $this->thumbnailPath;
    }
    
    public function setThumbnailPath(?string $thumbnailPath): self
    {
        $this->thumbnailPath = $thumbnailPath;
    
        return $this;
    }

    public function getDurationSeconds(): ?int
    {
        return $this->durationSeconds;
    }
    
    public function setDurationSeconds(?int $durationSeconds): self
    {
        $this->durationSeconds = $durationSeconds;
    
        return $this;
    }

    public function getLikesCount(): int
    {
        return $this->likesCount;
    }
    
    public function setLikesCount(int $likesCount): self
    {
        $this->likesCount = $likesCount;
    
        return $this;
    }

    public function getDislikesCount(): int
    {
        return $this->dislikesCount;
    }
    
    public function setDislikesCount(int $dislikesCount): self
    {
        $this->dislikesCount = $dislikesCount;
    
        return $this;
    }

    public function getSharesCount(): int
    {
        return $this->sharesCount;
    }
    
    public function setSharesCount(int $sharesCount): self
    {
        $this->sharesCount = $sharesCount;
    
        return $this;
    }

    public function getCommentsCount(): int
    {
        return $this->commentsCount;
    }
    
    public function setCommentsCount(int $commentsCount): self
    {
        $this->commentsCount = $commentsCount;
    
        return $this;
    }

    public function getVisibility(): string
    {
        return $this->visibility;
    }
    
    public function setVisibility(string $visibility): self
    {
        $this->visibility = $visibility;
    
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
    
    public function setStatus(string $status): self
    {
        $this->status = $status;
    
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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
    
    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }
    
    public function setAuthor(User $author): self
    {
        $this->author = $author;
    
        return $this;
    }
}
