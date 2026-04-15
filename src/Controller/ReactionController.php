<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use App\Entity\PostReaction;
use App\Repository\PostReactionRepository;
use App\Service\SocialNotificationManager;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class ReactionController extends AbstractSocialController
{
    #[Route('/social/posts/{id}/react/{reaction}', name: 'post_reaction_toggle', requirements: ['id' => '\d+', 'reaction' => 'like|dislike'], methods: ['POST'])]
    public function toggle(
        Post $post,
        string $reaction,
        Request $request,
        PostReactionRepository $postReactionRepository,
        EntityManagerInterface $entityManager,
        Security $security,
        SocialNotificationManager $notificationManager,
    ): RedirectResponse {
        if (! $this->isCsrfTokenValid(sprintf('react_%d_%s', $post->getId(), $reaction), (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'feed_page.flash.invalid_reaction');

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        $currentUser = $this->requireCurrentSocialUser($security);

        $normalizedReaction = strtoupper($reaction);
        $existingReaction = $postReactionRepository->findOneForPostAndUser((int) $post->getId(), (int) $currentUser->getId());
        $shouldNotify = false;

        if ($existingReaction === null) {
            $newReaction = new PostReaction();
            $newReaction->setPostId((int) $post->getId());
            $newReaction->setUserId((int) $currentUser->getId());
            $newReaction->setReaction($normalizedReaction);
            $newReaction->setCreatedAt(new DateTimeImmutable());

            $entityManager->persist($newReaction);
            $this->addFlash('success', $normalizedReaction === 'LIKE' ? 'feed_page.flash.like_added' : 'feed_page.flash.dislike_added');
            $shouldNotify = true;
        } elseif ($existingReaction->getReaction() === $normalizedReaction) {
            $entityManager->remove($existingReaction);
            $this->addFlash('success', $normalizedReaction === 'LIKE' ? 'feed_page.flash.like_removed' : 'feed_page.flash.dislike_removed');
        } else {
            $existingReaction->setReaction($normalizedReaction);
            $this->addFlash('success', 'feed_page.flash.reaction_updated');
            $shouldNotify = true;
        }

        $entityManager->flush();

        $post->setLikesCount($postReactionRepository->countForPostAndReaction((int) $post->getId(), 'LIKE'));
        $post->setDislikesCount($postReactionRepository->countForPostAndReaction((int) $post->getId(), 'DISLIKE'));

        if ($shouldNotify && $post->getAuthor()?->getId() !== null) {
            $notificationManager->create(
                (int) $post->getAuthor()->getId(),
                (int) $currentUser->getId(),
                $normalizedReaction === 'LIKE' ? 'POST_LIKE' : 'POST_DISLIKE',
                (int) $post->getId(),
                null,
                sprintf(
                    '%s %s your post.',
                    $currentUser->getName() ?? 'A member',
                    $normalizedReaction === 'LIKE' ? 'liked' : 'disliked',
                ),
            );
        }

        $entityManager->flush();

        return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
    }
}
