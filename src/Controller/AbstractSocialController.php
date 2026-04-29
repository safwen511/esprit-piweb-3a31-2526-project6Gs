<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;

abstract class AbstractSocialController extends AbstractController
{
    protected function getCurrentSocialUser(Security $security): ?User
    {
        $user = $security->getUser();

        return $user instanceof User ? $user : null;
    }

    protected function requireCurrentSocialUser(Security $security): User
    {
        $user = $this->getCurrentSocialUser($security);

        if ($user === null) {
            throw $this->createAccessDeniedException('feed_page.flash.sign_in_required');
        }

        return $user;
    }

    protected function denyUnlessPostOwner(?User $currentUser, Post $post): void
    {
        if ($currentUser === null || $post->getAuthor()->getId() !== $currentUser->getId()) {
            throw $this->createAccessDeniedException('feed_page.flash.manage_own_posts');
        }
    }

    protected function denyUnlessCommentCanBeDeleted(?User $currentUser, Comment $comment): void
    {
        $commentAuthorId = $comment->getAuthor()->getId();
        $postAuthorId = $comment->getPost()->getAuthor()->getId();

        if ($currentUser === null || ($currentUser->getId() !== $commentAuthorId && $currentUser->getId() !== $postAuthorId)) {
            throw $this->createAccessDeniedException('feed_page.flash.delete_own_comments');
        }
    }
}
