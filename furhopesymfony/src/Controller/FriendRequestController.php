<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\FriendRequest;
use App\Entity\Friendship;
use App\Repository\FriendRequestRepository;
use App\Repository\FriendshipRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/social/friends', name: 'friend_')]
final class FriendRequestController extends AbstractSocialController
{
    #[Route('/request/{id}', name: 'send', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function send(
        int $id,
        Request $request,
        UserRepository $userRepository,
        FriendRequestRepository $friendRequestRepository,
        FriendshipRepository $friendshipRepository,
        EntityManagerInterface $entityManager,
        Security $security,
    ): RedirectResponse {
        $currentUser = $this->requireCurrentSocialUser($security);

        if (!$this->isCsrfTokenValid('send_friend_request_'.$id, (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid friend request action.');

            return $this->redirectToRoute('feed_index');
        }

        $targetUser = $userRepository->find($id);
        if ($targetUser === null || $targetUser->getId() === null) {
            $this->addFlash('error', 'Member not found.');

            return $this->redirectToRoute('feed_index');
        }

        if ($currentUser->getId() === $targetUser->getId()) {
            $this->addFlash('warning', 'You cannot send a friend request to yourself.');

            return $this->redirectToRoute('feed_index');
        }

        if ($friendshipRepository->existsBetweenUsers((int) $currentUser->getId(), (int) $targetUser->getId())) {
            $this->addFlash('info', 'You are already connected with this member.');

            return $this->redirectToRoute('feed_index');
        }

        $existingRequest = $friendRequestRepository->findLatestBetweenUsers((int) $currentUser->getId(), (int) $targetUser->getId());
        if ($existingRequest !== null && $existingRequest->getStatus() === 'PENDING') {
            $this->addFlash('info', 'A friend request is already pending between you and this member.');

            return $this->redirectToRoute('feed_index');
        }

        $friendRequest = new FriendRequest();
        $friendRequest
            ->setSenderId((int) $currentUser->getId())
            ->setReceiverId((int) $targetUser->getId())
            ->setStatus('PENDING')
            ->setCreatedAt(new \DateTimeImmutable());

        $entityManager->persist($friendRequest);
        $entityManager->flush();

        $this->addFlash('success', sprintf('Friend request sent to %s.', $targetUser->getName() ?? 'this member'));

        return $this->redirectToRoute('feed_index', ['q' => $request->query->get('q')]);
    }

    #[Route('/request/{id}/accept', name: 'accept', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function accept(
        FriendRequest $friendRequest,
        Request $request,
        FriendshipRepository $friendshipRepository,
        EntityManagerInterface $entityManager,
        Security $security,
    ): RedirectResponse {
        $currentUser = $this->requireCurrentSocialUser($security);

        if (!$this->isCsrfTokenValid('accept_friend_request_'.$friendRequest->getId(), (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid friend request action.');

            return $this->redirectToRoute('feed_index');
        }

        if ($friendRequest->getReceiverId() !== $currentUser->getId() || $friendRequest->getStatus() !== 'PENDING') {
            throw $this->createAccessDeniedException('You cannot accept this request.');
        }

        $friendRequest->setStatus('ACCEPTED');

        $senderId = (int) $friendRequest->getSenderId();
        $receiverId = (int) $friendRequest->getReceiverId();
        if (!$friendshipRepository->existsBetweenUsers($senderId, $receiverId)) {
            $friendship = new Friendship();
            $friendship
                ->setUser1Id(min($senderId, $receiverId))
                ->setUser2Id(max($senderId, $receiverId))
                ->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($friendship);
        }

        $entityManager->flush();

        $this->addFlash('success', 'Friend request accepted.');

        return $this->redirectToRoute('feed_index');
    }

    #[Route('/request/{id}/decline', name: 'decline', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function decline(
        FriendRequest $friendRequest,
        Request $request,
        EntityManagerInterface $entityManager,
        Security $security,
    ): RedirectResponse {
        $currentUser = $this->requireCurrentSocialUser($security);

        if (!$this->isCsrfTokenValid('decline_friend_request_'.$friendRequest->getId(), (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid friend request action.');

            return $this->redirectToRoute('feed_index');
        }

        if ($friendRequest->getReceiverId() !== $currentUser->getId() || $friendRequest->getStatus() !== 'PENDING') {
            throw $this->createAccessDeniedException('You cannot decline this request.');
        }

        $friendRequest->setStatus('DECLINED');
        $entityManager->flush();

        $this->addFlash('info', 'Friend request declined.');

        return $this->redirectToRoute('feed_index');
    }
}
