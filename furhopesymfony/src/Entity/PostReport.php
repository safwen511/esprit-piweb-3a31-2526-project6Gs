<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PostReportRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostReportRepository::class)]
#[ORM\Table(name: 'post_report')]
#[ORM\UniqueConstraint(name: 'uq_post_reporter', columns: ['post_id', 'reporter_user_id'])]
class PostReport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: Types::BIGINT)]
    private ?int $id = null;

    #[ORM\Column(name: 'post_id', type: Types::BIGINT)]
    private ?int $postId = null;

    #[ORM\Column(name: 'reporter_user_id', type: Types::BIGINT)]
    private ?int $reporterUserId = null;

    #[ORM\Column(name: 'reason', type: Types::STRING, length: 255, nullable: true)]
    private ?string $reason = null;

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

    public function getReporterUserId(): ?int
    {
        return $this->reporterUserId;
    }
    
    public function setReporterUserId(?int $reporterUserId): self
    {
        $this->reporterUserId = $reporterUserId;
    
        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }
    
    public function setReason(?string $reason): self
    {
        $this->reason = $reason;
    
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