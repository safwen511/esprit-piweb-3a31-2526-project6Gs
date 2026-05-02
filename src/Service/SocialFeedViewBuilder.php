<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Comment;
use App\Entity\FriendRequest;
use App\Entity\Notification;
use App\Entity\Post;
use App\Entity\User;
use App\Repository\CommentRepository;
use App\Repository\FriendRequestRepository;
use App\Repository\FriendshipRepository;
use App\Repository\NotificationRepository;
use App\Repository\PostReactionRepository;
use App\Repository\PostReportRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Contracts\Translation\TranslatorInterface;

final class SocialFeedViewBuilder
{
    public function __construct(
        private readonly PostRepository $postRepository,
        private readonly CommentRepository $commentRepository,
        private readonly FriendRequestRepository $friendRequestRepository,
        private readonly FriendshipRepository $friendshipRepository,
        private readonly NotificationRepository $notificationRepository,
        private readonly PostReactionRepository $postReactionRepository,
        private readonly PostReportRepository $postReportRepository,
        private readonly UserRepository $userRepository,
        private readonly SocialMediaResolver $mediaResolver,
        private readonly TranslatorInterface $translator,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function buildFeed(User $currentUser, string $searchTerm): array
    {
        $currentUserId = (int) $currentUser->getId();
        $connections = $this->buildConnections($currentUser, $searchTerm);
        $friendIds = $connections['friendIds'];
        $posts = $this->postRepository->findFeedPosts($currentUser, $friendIds);
        $comments = $this->commentRepository->findActiveForPosts($posts);
        $notifications = $this->notificationRepository->findRecentForUser($currentUserId);

        $actorIds = array_map(
            static fn (Notification $notification): int => (int) $notification->getActorId(),
            $notifications,
        );
        $usersById = $this->userRepository->findIndexedByIds(array_values(array_unique(array_merge(
            array_map('intval', array_keys($connections['usersById'])),
            $actorIds,
        ))));

        $postIds = array_map(
            static fn (Post $post): int => (int) $post->getId(),
            $posts,
        );

        $commentsByPost = $this->groupCommentsByPost($comments);
        $userReactions = $this->postReactionRepository->findUserReactionsForPosts($postIds, $currentUserId);
        $reportedLookup = array_flip($this->postReportRepository->findReportedPostIdsForUser($postIds, $currentUserId));

        $feedPosts = [];
        foreach ($posts as $post) {
            $postId = (int) $post->getId();
            $feedPosts[] = $this->buildPostCard(
                $post,
                $currentUser,
                $userReactions[$postId] ?? null,
                isset($reportedLookup[$postId]),
                array_slice($commentsByPost[$postId] ?? [], -2),
            );
        }

        $notificationCards = [];
        foreach ($notifications as $notification) {
            $actorId = (int) $notification->getActorId();
            $meta = $this->notificationMeta((string) $notification->getType());

            $notificationCards[] = [
                'notification' => $notification,
                'actor' => $this->buildUserSummary($usersById[$actorId] ?? null),
                'icon' => $meta['icon'],
                'tone' => $meta['tone'],
                'message' => $notification->getMessage() ?: $meta['message'],
                'cta' => $meta['cta'],
                'createdLabel' => $this->formatAbsoluteTime($notification->getCreatedAt()),
                'createdRelative' => $this->formatRelativeTime($notification->getCreatedAt()),
            ];
        }

        $unreadCount = $this->notificationRepository->countUnreadForUser($currentUserId);

        return array_merge($connections, [
            'posts' => $posts,
            'commentsByPost' => $commentsByPost,
            'friendUsers' => array_values(array_filter(array_map(
                static fn (int $friendId): ?User => $usersById[$friendId] ?? null,
                $friendIds,
            ))),
            'notifications' => $notifications,
            'usersById' => $usersById,
            'userReactions' => $userReactions,
            'reportedPostIds' => array_keys($reportedLookup),
            'viewer' => $this->buildUserSummary($currentUser),
            'stats' => [
                ['label' => $this->translator->trans('feed_page.stats.visible_posts'), 'value' => count($feedPosts)],
                ['label' => $this->translator->trans('feed_page.stats.friends'), 'value' => count($friendIds)],
                ['label' => $this->translator->trans('feed_page.stats.unread_alerts'), 'value' => $unreadCount],
            ],
            'storyCards' => $this->buildStoryCards($feedPosts),
            'feedPosts' => $feedPosts,
            'notificationCards' => $notificationCards,
            'unreadNotificationCount' => $unreadCount,
        ]);
    }

    /**
     * @param list<Comment> $comments
     *
     * @return array<string, mixed>
     */
    public function buildPostDetail(User $currentUser, Post $post, array $comments): array
    {
        $currentUserId = (int) $currentUser->getId();
        $reactionLookup = $this->postReactionRepository->findUserReactionsForPosts([(int) $post->getId()], $currentUserId);

        return [
            'comments' => $comments,
            'postCard' => $this->buildPostCard(
                $post,
                $currentUser,
                $reactionLookup[(int) $post->getId()] ?? null,
                $this->postReportRepository->hasUserReported((int) $post->getId(), $currentUserId),
                [],
            ),
            'commentCount' => count($comments),
            'commentsByParent' => $this->groupCommentViewsByParent($comments, $currentUser, $post),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function buildConnections(User $currentUser, string $searchTerm): array
    {
        $currentUserId = (int) $currentUser->getId();
        $friendIds = $this->friendshipRepository->findFriendIdsForUser($currentUserId);
        $pendingRequests = $this->friendRequestRepository->findPendingReceivedForUser($currentUserId);
        $pendingSentUserIds = $this->friendRequestRepository->findPendingSentUserIds($currentUserId);
        $searchResults = $searchTerm !== ''
            ? $this->userRepository->searchSocialCandidates($currentUser, $searchTerm)
            : [];

        $pendingSenderIds = array_map(
            static fn (FriendRequest $friendRequest): int => (int) $friendRequest->getSenderId(),
            $pendingRequests,
        );

        $usersById = $this->userRepository->findIndexedByIds(array_values(array_unique(array_merge(
            $friendIds,
            $pendingSenderIds,
            array_map(static fn (User $user): int => (int) $user->getId(), $searchResults),
        ))));

        $incomingRequestMap = $this->indexPendingRequestsBySender($pendingRequests);
        $friendLookup = array_flip($friendIds);
        $pendingSentLookup = array_flip($pendingSentUserIds);

        $friendPreview = [];
        foreach (array_slice($friendIds, 0, 6) as $friendId) {
            if (!isset($usersById[$friendId])) {
                continue;
            }

            $friendPreview[] = $this->buildUserSummary($usersById[$friendId]);
        }

        $searchCards = [];
        foreach ($searchResults as $searchResult) {
            $searchUserId = (int) $searchResult->getId();
            $state = 'available';

            if (isset($friendLookup[$searchUserId])) {
                $state = 'friend';
            } elseif (isset($incomingRequestMap[$searchUserId])) {
                $state = 'incoming';
            } elseif (isset($pendingSentLookup[$searchUserId])) {
                $state = 'sent';
            }

            $searchCards[] = [
                'user' => $this->buildUserSummary($searchResult),
                'state' => $state,
                'incomingRequest' => $incomingRequestMap[$searchUserId] ?? null,
            ];
        }

        $requestCards = [];
        foreach ($pendingRequests as $pendingRequest) {
            $senderId = (int) $pendingRequest->getSenderId();
            $requestCards[] = [
                'request' => $pendingRequest,
                'sender' => $this->buildUserSummary($usersById[$senderId] ?? null),
                'createdLabel' => $this->formatAbsoluteTime($pendingRequest->getCreatedAt()),
                'createdRelative' => $this->formatRelativeTime($pendingRequest->getCreatedAt()),
            ];
        }

        return [
            'friendIds' => $friendIds,
            'pendingRequests' => $pendingRequests,
            'pendingRequestsBySenderId' => $incomingRequestMap,
            'pendingSentUserIds' => $pendingSentUserIds,
            'searchResults' => $searchResults,
            'searchTerm' => $searchTerm,
            'usersById' => $usersById,
            'friendPreview' => $friendPreview,
            'searchCards' => $searchCards,
            'requestCards' => $requestCards,
        ];
    }

    /**
     * @param list<Comment> $previewComments
     *
     * @return array<string, mixed>
     */
    private function buildPostCard(
        Post $post,
        User $currentUser,
        ?string $userReaction,
        bool $isReported,
        array $previewComments,
    ): array {
        $likeCount = (int) ($post->getLikesCount() ?? 0);
        $dislikeCount = (int) ($post->getDislikesCount() ?? 0);
        $commentCount = (int) ($post->getCommentsCount() ?? 0);
        $shareCount = (int) ($post->getSharesCount() ?? 0);

        $mediaUrl = $this->mediaResolver->resolveMediaUrl($post->getMediaPath());
        $mediaType = strtoupper((string) $post->getMediaType()) === 'VIDEO' ? 'video' : 'image';

        return [
            'entity' => $post,
            'id' => (int) $post->getId(),
            'author' => $this->buildUserSummary($post->getAuthor()),
            'caption' => trim((string) $post->getCaption()),
            'mediaUrl' => $mediaUrl,
            'mediaType' => $mediaType,
            'visibilityLabel' => $this->humanizeVisibility((string) $post->getVisibility()),
            'createdLabel' => $this->formatAbsoluteTime($post->getCreatedAt()),
            'createdRelative' => $this->formatRelativeTime($post->getCreatedAt()),
            'isOwner' => (int) $currentUser->getId() === (int) $post->getAuthor()?->getId(),
            'isReported' => $isReported,
            'reaction' => $userReaction,
            'likeCount' => $likeCount,
            'dislikeCount' => $dislikeCount,
            'commentCount' => $commentCount,
            'shareCount' => $shareCount,
            'reactionIcons' => $this->buildReactionIcons($likeCount, $dislikeCount, $commentCount, $shareCount),
            'previewComments' => array_map(
                fn (Comment $comment): array => $this->buildCommentView($comment, $currentUser, $post),
                $previewComments,
            ),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function buildCommentView(Comment $comment, User $currentUser, Post $post): array
    {
        $currentUserId = (int) $currentUser->getId();
        $authorId = (int) $comment->getAuthor()?->getId();
        $postAuthorId = (int) $post->getAuthor()?->getId();

        return [
            'entity' => $comment,
            'id' => (int) $comment->getId(),
            'parentId' => $comment->getParentComment()?->getId(),
            'author' => $this->buildUserSummary($comment->getAuthor()),
            'body' => trim((string) $comment->getBody()),
            'createdLabel' => $this->formatAbsoluteTime($comment->getCreatedAt()),
            'createdRelative' => $this->formatRelativeTime($comment->getCreatedAt()),
            'canDelete' => $currentUserId === $authorId || $currentUserId === $postAuthorId,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function buildUserSummary(?User $user): array
    {
        $email = (string) $user?->getEmail();
        $localPart = $email !== '' ? explode('@', $email)[0] : 'furhope';
        $handle = '@' . strtolower((string) preg_replace('/[^a-z0-9_.-]+/i', '', $localPart));

        return [
            'entity' => $user,
            'id' => (int) $user?->getId(),
            'name' => $user?->getName() ?: $this->translator->trans('feed_page.labels.unknown_member'),
            'email' => $email,
            'handle' => $handle !== '@' ? $handle : '@furhope',
            'initials' => $user?->getInitials() ?: '?',
            'avatarUrl' => $this->mediaResolver->resolveAvatarUrl($user),
        ];
    }

    /**
     * @param list<Comment> $comments
     *
     * @return array<int, list<Comment>>
     */
    private function groupCommentsByPost(array $comments): array
    {
        $commentsByPost = [];

        foreach ($comments as $comment) {
            $postId = $comment->getPost()?->getId();
            if ($postId === null) {
                continue;
            }

            $commentsByPost[$postId] ??= [];
            $commentsByPost[$postId][] = $comment;
        }

        return $commentsByPost;
    }

    /**
     * @param list<Comment> $comments
     *
     * @return array<string, list<array<string, mixed>>>
     */
    private function groupCommentViewsByParent(array $comments, User $currentUser, Post $post): array
    {
        $commentsByParent = ['root' => []];

        foreach ($comments as $comment) {
            $commentView = $this->buildCommentView($comment, $currentUser, $post);
            $parentKey = $commentView['parentId'] !== null ? (string) $commentView['parentId'] : 'root';

            $commentsByParent[$parentKey] ??= [];
            $commentsByParent[$parentKey][] = $commentView;
        }

        return $commentsByParent;
    }

    /**
     * @param list<FriendRequest> $pendingRequests
     *
     * @return array<int, FriendRequest>
     */
    private function indexPendingRequestsBySender(array $pendingRequests): array
    {
        $indexedRequests = [];

        foreach ($pendingRequests as $pendingRequest) {
            $senderId = $pendingRequest->getSenderId();
            if ($senderId === null) {
                continue;
            }

            $indexedRequests[$senderId] = $pendingRequest;
        }

        return $indexedRequests;
    }

    /**
     * @param list<array<string, mixed>> $feedPosts
     *
     * @return list<array<string, mixed>>
     */
    private function buildStoryCards(array $feedPosts): array
    {
        $storyCards = [];

        foreach ($feedPosts as $feedPost) {
            if (($feedPost['mediaType'] ?? 'image') !== 'image' || ($feedPost['mediaUrl'] ?? null) === null) {
                continue;
            }

            $storyCards[] = [
                'postId' => $feedPost['id'],
                'mediaUrl' => $feedPost['mediaUrl'],
                'author' => $feedPost['author'],
                'caption' => $this->excerpt((string) ($feedPost['caption'] ?: $this->translator->trans('feed_page.labels.fresh_update'))),
                'createdRelative' => $feedPost['createdRelative'],
            ];

            if (count($storyCards) === 5) {
                break;
            }
        }

        return $storyCards;
    }

    /**
     * @return list<string>
     */
    private function buildReactionIcons(int $likes, int $dislikes, int $comments, int $shares): array
    {
        $icons = [];

        if ($likes > 0) {
            $icons[] = 'like';
        }

        if ($comments > 0) {
            $icons[] = 'comment';
        }

        if ($shares > 0) {
            $icons[] = 'share';
        }

        if ($dislikes > 0) {
            $icons[] = 'dislike';
        }

        if ($icons === []) {
            $icons[] = 'paw';
        }

        return array_slice($icons, 0, 3);
    }

    /**
     * @return array{icon: string, tone: string, message: string, cta: string}
     */
    private function notificationMeta(string $type): array
    {
        return match ($type) {
            'POST_LIKE' => [
                'icon' => 'like',
                'tone' => 'social-notification--like',
                'message' => $this->translator->trans('feed_page.notification.like_message'),
                'cta' => $this->translator->trans('feed_page.notification.open_post'),
            ],
            'POST_DISLIKE' => [
                'icon' => 'feedback',
                'tone' => 'social-notification--feedback',
                'message' => $this->translator->trans('feed_page.notification.dislike_message'),
                'cta' => $this->translator->trans('feed_page.notification.review_post'),
            ],
            'POST_COMMENT' => [
                'icon' => 'comment',
                'tone' => 'social-notification--comment',
                'message' => $this->translator->trans('feed_page.notification.comment_message'),
                'cta' => $this->translator->trans('feed_page.notification.view_thread'),
            ],
            'COMMENT_REPLY' => [
                'icon' => 'reply',
                'tone' => 'social-notification--reply',
                'message' => $this->translator->trans('feed_page.notification.reply_message'),
                'cta' => $this->translator->trans('feed_page.notification.open_reply'),
            ],
            default => [
                'icon' => 'system',
                'tone' => 'social-notification--system',
                'message' => $this->translator->trans('feed_page.notification.activity_message'),
                'cta' => $this->translator->trans('feed_page.notification.view'),
            ],
        };
    }

    private function humanizeVisibility(string $visibility): string
    {
        return match (strtoupper($visibility)) {
            'FRIENDS' => $this->translator->trans('feed_page.visibility.friends_only'),
            'PRIVATE' => $this->translator->trans('feed_page.visibility.only_you'),
            default => $this->translator->trans('feed_page.visibility.public_feed'),
        };
    }

    private function formatAbsoluteTime(?\DateTimeImmutable $dateTime): string
    {
        return $dateTime?->format('d M Y \a\t H:i') ?? $this->translator->trans('feed_page.labels.just_now');
    }

    private function formatRelativeTime(?\DateTimeImmutable $dateTime): string
    {
        if ($dateTime === null) {
            return $this->translator->trans('feed_page.labels.just_now_lower');
        }

        $seconds = max(0, time() - $dateTime->getTimestamp());

        if ($seconds < 60) {
            return $this->translator->trans('feed_page.labels.just_now_lower');
        }

        if ($seconds < 3600) {
            return (string) floor($seconds / 60) . 'm';
        }

        if ($seconds < 86400) {
            return (string) floor($seconds / 3600) . 'h';
        }

        if ($seconds < 604800) {
            return (string) floor($seconds / 86400) . 'd';
        }

        return $dateTime->format('d M');
    }

    private function excerpt(string $text, int $limit = 64): string
    {
        $text = trim(preg_replace('/\s+/', ' ', strip_tags($text)) ?? '');
        if ($text === '') {
            return $this->translator->trans('feed_page.labels.fresh_update');
        }

        if (mb_strlen($text) <= $limit) {
            return $text;
        }

        return rtrim(mb_substr($text, 0, $limit - 3)) . '...';
    }
}
