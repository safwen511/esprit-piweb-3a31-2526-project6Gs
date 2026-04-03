<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use App\Entity\PostReport;
use App\Repository\PostReportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class PostReportController extends AbstractSocialController
{
    #[Route('/social/posts/{id}/report', name: 'post_report', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function report(
        Post $post,
        Request $request,
        PostReportRepository $postReportRepository,
        EntityManagerInterface $entityManager,
        Security $security,
    ): RedirectResponse {
        $currentUser = $this->requireCurrentSocialUser($security);

        if (!$this->isCsrfTokenValid('report_post_'.$post->getId(), (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid report request.');

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        if ($post->getAuthor()?->getId() === $currentUser->getId()) {
            $this->addFlash('warning', 'You cannot report your own post.');

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        if ($postReportRepository->hasUserReported((int) $post->getId(), (int) $currentUser->getId())) {
            $this->addFlash('info', 'You already reported this post.');

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        $report = new PostReport();
        $report
            ->setPostId((int) $post->getId())
            ->setReporterUserId((int) $currentUser->getId())
            ->setReason(trim((string) $request->request->get('reason')) ?: 'Reported from the social feed')
            ->setCreatedAt(new \DateTimeImmutable());

        $entityManager->persist($report);
        $entityManager->flush();

        $this->addFlash('success', 'Thanks. The post has been reported for review.');

        return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
    }
}
