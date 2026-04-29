<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdminUserType;
use App\Form\UserSearchType;
use App\Model\UserSearchData;
use App\Repository\UserRepository;
use App\Service\UserAccountManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class AdminUserController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserAccountManager $userAccountManager,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/admin/user', name: 'admin_user_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $perPage = 40;
        $searchData = new UserSearchData();
        $form = $this->createForm(UserSearchType::class, $searchData);
        $form->handleRequest($request);

        $page = max(1, $request->query->getInt('page', 1));
        $term = trim((string) $searchData->term);
        $totalUsers = $this->userRepository->countAdminUserSummaries($searchData);
        $totalPages = max(1, (int) ceil($totalUsers / $perPage));
        $page = min($page, $totalPages);
        $users = $this->userRepository->searchAdminUserSummaries($searchData, $perPage, ($page - 1) * $perPage);

        return $this->render('admin_user/index.html.twig', [
            'users' => $users,
            'searchForm' => $form,
            'hasFilters' => $term !== '' || $searchData->status !== UserSearchData::STATUS_ALL,
            'page' => $page,
            'perPage' => $perPage,
            'totalUsers' => $totalUsers,
            'totalPages' => $totalPages,
        ]);
    }

    #[Route('/admin/user/{id}', name: 'admin_user_detail', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function detail(int $id): Response
    {
        return $this->render('admin_user/detail.html.twig', [
            'managedUser' => $this->findUserOr404($id),
        ]);
    }

    #[Route('/admin/user/{id}/edit', name: 'admin_user_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id): Response
    {
        $managedUser = $this->findUserOr404($id);
        $form = $this->createForm(AdminUserType::class, $managedUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($managedUser);
            $this->entityManager->flush();
            $this->addFlash('success', sprintf('%s was updated.', $managedUser->getFullName()));

            return $this->redirectToRoute('admin_user_detail', ['id' => $managedUser->getId()]);
        }

        return $this->render('admin_user/edit.html.twig', [
            'managedUser' => $managedUser,
            'form' => $form,
        ]);
    }

    #[Route('/admin/user/{id}/deactivate', name: 'admin_user_deactivate', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function deactivate(Request $request, int $id): RedirectResponse
    {
        $managedUser = $this->findUserOr404($id);
        if (!$this->isCsrfTokenValid('admin_user_deactivate_'.$id, (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid CSRF token.');
        }

        $admin = $this->getAdminUser();
        if ($this->userAccountManager->block($admin, $managedUser)) {
            $this->addFlash('success', sprintf('%s has been deactivated.', $managedUser->getFullName()));
        } else {
            $this->addFlash('warning', 'This account cannot be deactivated.');
        }

        return $this->redirectToRoute('admin_user_index');
    }

    #[Route('/admin/user/{id}/activate', name: 'admin_user_activate', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function activate(Request $request, int $id): RedirectResponse
    {
        $managedUser = $this->findUserOr404($id);
        if (!$this->isCsrfTokenValid('admin_user_activate_'.$id, (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid CSRF token.');
        }

        $admin = $this->getAdminUser();
        if ($this->userAccountManager->unblock($admin, $managedUser)) {
            $this->addFlash('success', sprintf('%s has been activated.', $managedUser->getFullName()));
        } else {
            $this->addFlash('warning', 'This account is already active.');
        }

        return $this->redirectToRoute('admin_user_index');
    }

    #[Route('/admin/user/{id}/approve-vet', name: 'admin_user_approve_vet', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function approveVeterinaire(Request $request, int $id): RedirectResponse
    {
        $managedUser = $this->findUserOr404($id);
        if (!$this->isCsrfTokenValid('admin_user_approve_vet_'.$id, (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid CSRF token.');
        }

        if ($this->userAccountManager->approveVeterinaryRequest($managedUser)) {
            $this->addFlash('success', sprintf('%s has been approved as a veterinaire.', $managedUser->getFullName()));
        } else {
            $this->addFlash('warning', 'This veterinary request cannot be approved.');
        }

        return $this->redirectToRoute('admin_user_index');
    }

    #[Route('/admin/user/{id}/reject-vet', name: 'admin_user_reject_vet', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function rejectVeterinaire(Request $request, int $id): RedirectResponse
    {
        $managedUser = $this->findUserOr404($id);
        if (!$this->isCsrfTokenValid('admin_user_reject_vet_'.$id, (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid CSRF token.');
        }

        if ($this->userAccountManager->rejectVeterinaryRequest($managedUser)) {
            $this->addFlash('success', sprintf('%s veterinary request has been rejected.', $managedUser->getFullName()));
        } else {
            $this->addFlash('warning', 'This veterinary request cannot be rejected.');
        }

        return $this->redirectToRoute('admin_user_index');
    }

    #[Route('/admin/user/{id}/verify', name: 'admin_user_verify', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function verify(Request $request, int $id): RedirectResponse
    {
        $managedUser = $this->findUserOr404($id);
        if (!$this->isCsrfTokenValid('admin_user_verify_'.$id, (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid CSRF token.');
        }

        if ($managedUser->isVerified()) {
            $this->addFlash('warning', 'This account is already verified.');

            return $this->redirectToRoute('admin_user_index');
        }

        $managedUser->setIsVerified(true);
        $this->entityManager->flush();
        $this->addFlash('success', sprintf('%s is now verified.', $managedUser->getFullName()));

        return $this->redirectToRoute('admin_user_index');
    }

    #[Route('/admin/user/{id}/unverify', name: 'admin_user_unverify', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function unverify(Request $request, int $id): RedirectResponse
    {
        $managedUser = $this->findUserOr404($id);
        if (!$this->isCsrfTokenValid('admin_user_unverify_'.$id, (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid CSRF token.');
        }

        if (!$managedUser->isVerified()) {
            $this->addFlash('warning', 'This account is already unverified.');

            return $this->redirectToRoute('admin_user_index');
        }

        $managedUser->setIsVerified(false);
        $this->entityManager->flush();
        $this->addFlash('success', sprintf('%s is now unverified.', $managedUser->getFullName()));

        return $this->redirectToRoute('admin_user_index');
    }

    #[Route('/admin/user/{id}/delete', name: 'admin_user_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(Request $request, int $id): RedirectResponse
    {
        $managedUser = $this->findUserOr404($id);
        if (!$this->isCsrfTokenValid('admin_user_delete_'.$id, (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid CSRF token.');
        }

        $admin = $this->getAdminUser();

        try {
            if ($this->userAccountManager->delete($admin, $managedUser)) {
                $this->addFlash('success', sprintf('%s has been deleted.', $managedUser->getFullName()));
            } else {
                $this->addFlash('warning', 'This user cannot be deleted.');
            }
        } catch (\Throwable) {
            $this->addFlash('warning', 'This user cannot be deleted because related records still exist.');
        }

        return $this->redirectToRoute('admin_user_index');
    }

    private function findUserOr404(int $id): User
    {
        $user = $this->userRepository->find($id);
        if (!$user instanceof User || in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            throw $this->createNotFoundException('User not found.');
        }

        return $user;
    }

    private function getAdminUser(): User
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('Administrator account required.');
        }

        return $user;
    }
}
