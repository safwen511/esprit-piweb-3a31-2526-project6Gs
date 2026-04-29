<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Repository\CommentRepository;
use App\Service\SocialNotificationManager;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class CommentController extends AbstractSocialController
{
    #[Route('/social/posts/{id}/comments', name: 'comment_create', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function create(
        Post $post,
        Request $request,
        CommentRepository $commentRepository,
        EntityManagerInterface $entityManager,
        Security $security,
        SocialNotificationManager $notificationManager,
    ): RedirectResponse {
        $currentUser = $this->requireCurrentSocialUser($security);
        if (! $this->isCsrfTokenValid('comment_post_' . $post->getId(), (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'feed_page.flash.invalid_comment');

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        $body = trim((string) $request->request->get('body'));
        if ($body === '') {
            $this->addFlash('error', 'feed_page.flash.comment_empty');

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        $comment = new Comment();
        $comment->setPost($post);
        $comment->setAuthor($currentUser);
        $comment->setBody($body);

        $parentCommentId = $request->request->getInt('parent_comment_id');
        if ($parentCommentId > 0) {
            $parentComment = $commentRepository->find($parentCommentId);
            if (!$parentComment instanceof Comment || $parentComment->getPost()->getId() !== $post->getId()) {
                $this->addFlash('error', 'feed_page.flash.reply_target_missing');

                return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
            }

            $comment->setParentComment($parentComment);
        }

        $comment->setCreatedAt(new DateTimeImmutable());
        $comment->setStatus('ACTIVE');

        $entityManager->persist($comment);
        $entityManager->flush();

        $post->setCommentsCount($commentRepository->countActiveForPost($post));
        if ($post->getAuthor()->getId() !== null) {
            $notificationManager->create(
                (int) $post->getAuthor()->getId(),
                (int) $currentUser->getId(),
                'POST_COMMENT',
                (int) $post->getId(),
                (int) $comment->getId(),
                sprintf('%s commented on your post.', $currentUser->getName() ?? 'A member'),
            );
        }

        $parentAuthorId = $comment->getParentComment()?->getAuthor()?->getId();
        if ($parentAuthorId !== null && $parentAuthorId !== $currentUser->getId() && $parentAuthorId !== $post->getAuthor()->getId()) {
            $notificationManager->create(
                (int) $parentAuthorId,
                (int) $currentUser->getId(),
                'COMMENT_REPLY',
                (int) $post->getId(),
                (int) $comment->getId(),
                sprintf('%s replied to your comment.', $currentUser->getName() ?? 'A member'),
            );
        }

        $entityManager->flush();

        $this->addFlash('success', 'feed_page.flash.comment_added');

        return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
    }

    #[Route('/social/comments/{id}/delete', name: 'comment_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(
        Comment $comment,
        Request $request,
        CommentRepository $commentRepository,
        EntityManagerInterface $entityManager,
        Security $security,
    ): RedirectResponse {
        $this->denyUnlessCommentCanBeDeleted($this->requireCurrentSocialUser($security), $comment);

        $post = $comment->getPost();

        if (! $this->isCsrfTokenValid('delete_comment_' . $comment->getId(), (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'feed_page.flash.invalid_delete');

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        $entityManager->remove($comment);
        $entityManager->flush();

        $post->setCommentsCount($commentRepository->countActiveForPost($post));
        $entityManager->flush();

        $this->addFlash('success', 'feed_page.flash.comment_deleted');

        return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
    }
}
