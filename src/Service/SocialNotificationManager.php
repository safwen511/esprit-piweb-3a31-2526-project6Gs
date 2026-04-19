<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;

final class SocialNotificationManager
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function create(
        int $recipientId,
        int $actorId,
        string $type,
        ?int $postId = null,
        ?int $commentId = null,
        ?string $message = null,
    ): void {
        if ($recipientId === $actorId) {
            return;
        }

        $notification = new Notification();
        $notification
            ->setRecipientId($recipientId)
            ->setActorId($actorId)
            ->setType($type)
            ->setPostId($postId)
            ->setCommentId($commentId)
            ->setMessage($message)
            ->setIsRead(false)
            ->setCreatedAt(new \DateTimeImmutable());

        $this->entityManager->persist($notification);
    }
}
