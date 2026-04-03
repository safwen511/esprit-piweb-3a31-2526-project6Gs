<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Service\SocialFeedViewBuilder;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class FeedController extends AbstractSocialController
{
    #[Route('/social', name: 'feed_index', methods: ['GET'])]
    #[Route('/social/feed', name: 'feed_list', methods: ['GET'])]
    public function index(
        Request $request,
        SocialFeedViewBuilder $socialFeedViewBuilder,
        Security $security,
    ): Response
    {
        $currentUser = $this->requireCurrentSocialUser($security);
        $searchTerm = trim((string) $request->query->get('q'));
        $postForm = $this->createForm(PostType::class, (new Post())->setAuthor($currentUser), [
            'allow_author_selection' => false,
        ]);

        return $this->render('feed/index.html.twig', array_merge(
            $socialFeedViewBuilder->buildFeed($currentUser, $searchTerm),
            [
            'currentUserEntity' => $currentUser,
            'postForm' => $postForm->createView(),
            ],
        ));
    }

    #[Route('/social/search/members', name: 'feed_search_members', methods: ['GET'])]
    public function searchMembers(
        Request $request,
        SocialFeedViewBuilder $socialFeedViewBuilder,
        Security $security,
    ): Response {
        $currentUser = $this->requireCurrentSocialUser($security);
        $searchTerm = trim((string) $request->query->get('q'));

        return $this->render('feed/_connection_results.html.twig', array_merge(
            $socialFeedViewBuilder->buildConnections($currentUser, $searchTerm),
            [
                'searchTerm' => $searchTerm,
            ],
        ));
    }
}
