<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\PostReactionRepository;
use App\Repository\PostRepository;
use App\Repository\PostShareRepository;
use App\Service\SocialAnalyticsChartBuilder;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class SocialManagementController extends AbstractSocialController
{
    #[Route('/dashboard/social', name: 'app_social_management', methods: ['GET'])]
    public function index(
        PostRepository $postRepository,
        PostReactionRepository $postReactionRepository,
        PostShareRepository $postShareRepository,
        SocialAnalyticsChartBuilder $chartBuilder,
        Security $security,
    ): Response {
        $currentUser = $this->requireCurrentSocialUser($security);
        $posts = $postRepository->findByAuthor($currentUser);
        $overview = $postRepository->getAuthorOverview((int) $currentUser->getId());
        $since = (new \DateTimeImmutable('today'))->modify('-6 days');

        $reactionRows = $postReactionRepository->getDailyTotalsForAuthorPosts((int) $currentUser->getId(), $since);
        $shareRows = $postShareRepository->getDailyTotalsForAuthorPosts((int) $currentUser->getId(), $since);

        $dailyStats = [];
        for ($index = 0; $index < 7; ++$index) {
            $day = $since->modify(sprintf('+%d days', $index));
            $key = $day->format('Y-m-d');
            $dailyStats[$key] = [
                'label' => $day->format('d M'),
                'likes' => 0,
                'dislikes' => 0,
                'shares' => 0,
            ];
        }

        foreach ($reactionRows as $row) {
            if (!isset($dailyStats[$row['day']])) {
                continue;
            }

            if ($row['reaction'] === 'LIKE') {
                $dailyStats[$row['day']]['likes'] += $row['total'];
            }

            if ($row['reaction'] === 'DISLIKE') {
                $dailyStats[$row['day']]['dislikes'] += $row['total'];
            }
        }

        foreach ($shareRows as $row) {
            if (isset($dailyStats[$row['day']])) {
                $dailyStats[$row['day']]['shares'] += $row['total'];
            }
        }

        $dailyStats = array_values($dailyStats);

        return $this->render('feed/management.html.twig', [
            'currentUserEntity' => $currentUser,
            'posts' => $posts,
            'overview' => $overview,
            'dailyStats' => $dailyStats,
            'dailyEngagementChart' => $chartBuilder->buildDailyEngagementChart($dailyStats),
            'engagementBreakdownChart' => $chartBuilder->buildEngagementBreakdownChart($overview),
        ]);
    }
}
