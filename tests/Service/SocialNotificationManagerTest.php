<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Notification;
use App\Service\SocialNotificationManager;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

final class SocialNotificationManagerTest extends TestCase
{
    public function testCreatePersistsUnreadNotificationForDifferentUsers(): void
    {
        $persisted = null;
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects(self::once())
            ->method('persist')
            ->with(self::callback(static function (Notification $notification) use (&$persisted): bool {
                $persisted = $notification;

                return true;
            }));

        (new SocialNotificationManager($entityManager))->create(5, 7, 'POST_COMMENT', 11, 13, 'New comment');

        self::assertInstanceOf(Notification::class, $persisted);
        self::assertSame(5, $persisted->getRecipientId());
        self::assertSame(7, $persisted->getActorId());
        self::assertSame('POST_COMMENT', $persisted->getType());
        self::assertSame(11, $persisted->getPostId());
        self::assertSame(13, $persisted->getCommentId());
        self::assertSame('New comment', $persisted->getMessage());
        self::assertFalse($persisted->isRead());
    }

    public function testCreateSkipsSelfNotifications(): void
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects(self::never())->method('persist');

        (new SocialNotificationManager($entityManager))->create(5, 5, 'POST_LIKE');
    }
}
