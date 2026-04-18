<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\CommentRepository;
use App\Repository\FriendshipRepository;
use App\Repository\PostRepository;
use App\Service\SocialAiService;
use App\Service\SocialFeedViewBuilder;
use App\Service\SocialPostMediaUploader;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/social/posts', name: 'post_')]
final class PostController extends AbstractSocialController
{
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        SocialAiService $socialAiService,
        SocialPostMediaUploader $socialPostMediaUploader,
        Security $security,
    ): Response {
        $currentUser = $this->requireCurrentSocialUser($security);
        $post = new Post();
        $post->setAuthor($currentUser);

        $form = $this->createForm(PostType::class, $post, [
            'allow_author_selection' => false,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $this->validateRenderablePost($form, $post);
            $this->applyAiModeration($form, $post, $socialAiService);

            if ($form->isValid()) {
                $this->applyUploadedMedia($form, $post, $socialPostMediaUploader);
                $this->preparePostForSave($post, true);

                $entityManager->persist($post);
                $entityManager->flush();

                $this->addFlash('success', 'feed_page.flash.post_created');

                return $this->redirectToRoute('feed_index');
            }
        }

        return $this->render('post/new.html.twig', [
            'form' => $form->createView(),
            'currentUserEntity' => $currentUser,
        ], new Response(status: $form->isSubmitted() ? Response::HTTP_UNPROCESSABLE_ENTITY : Response::HTTP_OK));
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(
        int $id,
        PostRepository $postRepository,
        CommentRepository $commentRepository,
        FriendshipRepository $friendshipRepository,
        SocialFeedViewBuilder $socialFeedViewBuilder,
        Security $security,
    ): Response {
        $currentUser = $this->requireCurrentSocialUser($security);
        $friendIds = $friendshipRepository->findFriendIdsForUser((int) $currentUser->getId());
        $post = $postRepository->findOneVisiblePost($id, $currentUser, $friendIds);

        if ($post === null) {
            throw $this->createNotFoundException('feed_page.flash.post_not_found');
        }

        return $this->render('post/show.html.twig', array_merge(
            $socialFeedViewBuilder->buildPostDetail($currentUser, $post, $commentRepository->findActiveForPost($post)),
            [
            'post' => $post,
            'currentUserEntity' => $currentUser,
            ],
        ));
    }

    #[Route('/{id}/edit', name: 'edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(
        Post $post,
        Request $request,
        EntityManagerInterface $entityManager,
        SocialAiService $socialAiService,
        SocialPostMediaUploader $socialPostMediaUploader,
        Security $security,
    ): Response {
        $currentUser = $this->requireCurrentSocialUser($security);
        $this->denyUnlessPostOwner($currentUser, $post);

        $form = $this->createForm(PostType::class, $post, [
            'allow_author_selection' => false,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $this->validateRenderablePost($form, $post);
            $this->applyAiModeration($form, $post, $socialAiService);

            if ($form->isValid()) {
                $this->applyUploadedMedia($form, $post, $socialPostMediaUploader);
                $this->preparePostForSave($post, false);
                $entityManager->flush();

                $this->addFlash('success', 'feed_page.flash.post_updated');

                return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
            }
        }

        return $this->render('post/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
            'currentUserEntity' => $currentUser,
        ], new Response(status: $form->isSubmitted() ? Response::HTTP_UNPROCESSABLE_ENTITY : Response::HTTP_OK));
    }

    #[Route('/{id}/delete', name: 'delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(
        Post $post,
        Request $request,
        EntityManagerInterface $entityManager,
        Security $security,
    ): RedirectResponse {
        $this->denyUnlessPostOwner($this->requireCurrentSocialUser($security), $post);

        if (! $this->isCsrfTokenValid('delete_post_' . $post->getId(), (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'feed_page.flash.invalid_delete');

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        $entityManager->remove($post);
        $entityManager->flush();

        $this->addFlash('success', 'feed_page.flash.post_deleted');

        return $this->redirectToRoute('feed_index');
    }

    private function preparePostForSave(Post $post, bool $isNew): void
    {
        $now = new DateTimeImmutable();
        $post->setCaption($this->normalizeNullableText($post->getCaption()));
        $post->setMediaPath($this->normalizeNullableText($post->getMediaPath()));

        if ($isNew) {
            $post->setCreatedAt($now);
            $post->setStatus('ACTIVE');
            $post->setLikesCount($post->getLikesCount() ?? 0);
            $post->setDislikesCount($post->getDislikesCount() ?? 0);
            $post->setCommentsCount($post->getCommentsCount() ?? 0);
            $post->setSharesCount($post->getSharesCount() ?? 0);
        }

        $post->setUpdatedAt($now);

        if ($post->getMediaType() === 'NONE') {
            $post->setMediaPath(null);
            $post->setThumbnailPath(null);
            $post->setDurationSeconds(null);
        }

        if ($post->getMediaType() !== 'VIDEO') {
            $post->setDurationSeconds(null);
        }
    }

    private function validateRenderablePost(FormInterface $form, Post $post): void
    {
        $caption = trim((string) $post->getCaption());
        $mediaPath = trim((string) $post->getMediaPath());
        /** @var UploadedFile|null $mediaFile */
        $mediaFile = $form->has('mediaFile') ? $form->get('mediaFile')->getData() : null;

        if ($caption === '' && $mediaPath === '' && !$mediaFile instanceof UploadedFile) {
            $form->get('caption')->addError(new FormError('feed_page.validation.post_content_required'));
        }
    }

    private function applyUploadedMedia(
        FormInterface $form,
        Post $post,
        SocialPostMediaUploader $socialPostMediaUploader,
    ): void {
        /** @var UploadedFile|null $mediaFile */
        $mediaFile = $form->has('mediaFile') ? $form->get('mediaFile')->getData() : null;

        if (!$mediaFile instanceof UploadedFile) {
            return;
        }

        $post->setMediaType($socialPostMediaUploader->detectMediaType($mediaFile));
        $post->setMediaPath($socialPostMediaUploader->upload($mediaFile));
    }

    private function applyAiModeration(
        FormInterface $form,
        Post $post,
        SocialAiService $socialAiService,
    ): void {
        /** @var UploadedFile|null $mediaFile */
        $mediaFile = $form->has('mediaFile') ? $form->get('mediaFile')->getData() : null;

        try {
            $moderation = $socialAiService->moderatePostDraft(
                $post->getCaption(),
                $post->getMediaType(),
                $mediaFile,
                $post->getMediaPath(),
            );
        } catch (\RuntimeException $exception) {
            if ($this->containsBlockedFallbackLanguage($post->getCaption())) {
                $form->get('caption')->addError(new FormError('feed_page.validation.caption_blocked'));
            }

            $hasImageToReview = strtoupper(trim((string) $post->getMediaType())) === 'IMAGE'
                && ($mediaFile instanceof UploadedFile || trim((string) $post->getMediaPath()) !== '');

            if ($hasImageToReview) {
                $field = $mediaFile instanceof UploadedFile ? 'mediaFile' : 'mediaPath';
                $form->get($field)->addError(new FormError('feed_page.validation.ai_warming_up'));
            }

            return;
        }

        if (($moderation['caption']['blocked'] ?? false) === true) {
            $form->get('caption')->addError(new FormError('feed_page.validation.caption_blocked'));
        }

        if (($moderation['image']['blocked'] ?? false) !== true) {
            return;
        }

        $reason = strtolower((string) ($moderation['image']['reason'] ?? ''));
        $field = $form->has('mediaFile') ? 'mediaFile' : 'mediaPath';
        $message = str_contains($reason, 'unsafe')
            ? 'feed_page.validation.image_unsafe'
            : 'feed_page.validation.image_must_be_animal';

        $form->get($field)->addError(new FormError($message));
    }

    private function containsBlockedFallbackLanguage(?string $caption): bool
    {
        $normalizedCaption = trim((string) $caption);
        if ($normalizedCaption === '') {
            return false;
        }

        $patterns = [
            '/\bfuck(?:ing|er|ed)?\b/i',
            '/\bshit(?:ty|ting)?\b/i',
            '/\basshole\b/i',
            '/\bbitch(?:es)?\b/i',
            '/\bmerde\b/i',
            '/\bpute\b/i',
            '/\bconn?ard(?:e)?\b/i',
            '/\bcon\b/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $normalizedCaption) === 1) {
                return true;
            }
        }

        return false;
    }

    private function normalizeNullableText(?string $value): ?string
    {
        $normalized = trim((string) $value);

        return $normalized !== '' ? $normalized : null;
    }
}
