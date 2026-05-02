<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UserAccountManager;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @extends AbstractCrudController<User>
 */
class UserCrudController extends AbstractCrudController
{
    public function __construct(
        private readonly UserAccountManager $userAccountManager,
        private readonly AdminUrlGenerator $adminUrlGenerator,
        private readonly UserRepository $userRepository,
    )
    {
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Member')
            ->setEntityLabelInPlural('Members')
            ->setPageTitle(Crud::PAGE_INDEX, 'User management')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Member profile')
            ->setPageTitle(Crud::PAGE_EDIT, 'Edit member')
            ->setPageTitle(Crud::PAGE_NEW, 'Create member')
            ->setHelp(Crud::PAGE_INDEX, 'Admins are hidden from this list. Use the action buttons to activate, deactivate, and review veterinary requests.')
            ->showEntityActionsInlined()
            ->setSearchFields(['email', 'firstName', 'lastName', 'phoneNumber'])
            ->setDefaultSort(['isVeteranApplicant' => 'DESC', 'createdAt' => 'DESC'])
            ->setPaginatorPageSize(12);
    }

    public function configureActions(Actions $actions): Actions
    {
        $block = Action::new('blockUser', 'Deactivate')
            ->linkToRoute('admin_user_deactivate', static fn (User $user): array => ['id' => $user->getId()])
            ->setIcon('fa fa-user-slash')
            ->setCssClass('btn btn-warning')
            ->displayIf(static fn (User $user) => $user->isActive());

        $unblock = Action::new('unblockUser', 'Activate')
            ->linkToRoute('admin_user_activate', static fn (User $user): array => ['id' => $user->getId()])
            ->setIcon('fa fa-user-check')
            ->setCssClass('btn btn-success')
            ->displayIf(static fn (User $user) => !$user->isActive());

        $approveVeterinaryRequest = Action::new('approveVeterinaryRequest', 'Approve vet')
            ->linkToRoute('admin_user_approve_vet', static fn (User $user): array => ['id' => $user->getId()])
            ->setIcon('fa fa-stethoscope')
            ->setCssClass('btn btn-primary')
            ->displayIf(static fn (User $user) => $user->isVeteranApplicant() && !$user->isVeteranApproved());

        $rejectVeterinaryRequest = Action::new('rejectVeterinaryRequest', 'Reject vet')
            ->linkToRoute('admin_user_reject_vet', static fn (User $user): array => ['id' => $user->getId()])
            ->setIcon('fa fa-times')
            ->setCssClass('btn btn-secondary')
            ->displayIf(static fn (User $user) => $user->isVeteranApplicant() && !$user->isVeteranApproved());

        return $actions
            ->add(Crud::PAGE_INDEX, $block)
            ->add(Crud::PAGE_DETAIL, $block)
            ->add(Crud::PAGE_INDEX, $unblock)
            ->add(Crud::PAGE_DETAIL, $unblock)
            ->add(Crud::PAGE_INDEX, $approveVeterinaryRequest)
            ->add(Crud::PAGE_DETAIL, $approveVeterinaryRequest)
            ->add(Crud::PAGE_INDEX, $rejectVeterinaryRequest)
            ->add(Crud::PAGE_DETAIL, $rejectVeterinaryRequest)
            ->update(Crud::PAGE_INDEX, Action::EDIT, static fn (Action $action) => $action->setLabel('Edit'))
            ->update(Crud::PAGE_INDEX, Action::DELETE, static fn (Action $action) => $action->setLabel('Delete'));
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstName', 'First name'),
            TextField::new('lastName', 'Last name'),
            EmailField::new('email'),
            TextField::new('phoneNumber', 'Phone'),
            BooleanField::new('isVerified', 'Verified'),
            TextField::new('accountStatusLabel', 'Account status')->hideOnForm(),
            BooleanField::new('isVeteranApplicant')->setLabel('Veterinary request')->hideOnForm(),
            TextField::new('veterinaryRequestStatusLabel', 'Veterinary review')->hideOnForm(),
            TextField::new('createdAtLabel', 'Created at')->hideOnForm(),
            TextField::new('updatedAtLabel', 'Updated at')->hideOnForm(),
        ];
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $alias = $queryBuilder->getRootAliases()[0] ?? 'entity';

        return $queryBuilder
            ->andWhere(sprintf('%s.roles NOT LIKE :adminRole', $alias))
            ->setParameter('adminRole', '%ROLE_ADMIN%');
    }

    #[Route('/admin/user/{id}/deactivate', name: 'admin_user_deactivate', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function blockUser(int $id): RedirectResponse
    {
        $user = $this->getManagedUserById($id);
        $admin = $this->getAdminUser();

        if (!$this->userAccountManager->block($admin, $user)) {
            $this->addFlash('warning', 'This account cannot be deactivated.');

            return $this->redirectToUserManagement();
        }

        $this->addFlash('success', sprintf('%s has been deactivated.', $user->getFullName()));

        return $this->redirectToUserManagement();
    }

    #[Route('/admin/user/{id}/activate', name: 'admin_user_activate', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function unblockUser(int $id): RedirectResponse
    {
        $user = $this->getManagedUserById($id);
        $admin = $this->getAdminUser();

        if (!$this->userAccountManager->unblock($admin, $user)) {
            $this->addFlash('warning', 'This account is already active.');

            return $this->redirectToUserManagement();
        }

        $this->addFlash('success', sprintf('%s has been activated.', $user->getFullName()));

        return $this->redirectToUserManagement();
    }

    #[Route('/admin/user/{id}/approve-vet', name: 'admin_user_approve_vet', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function approveVeterinaryRequest(int $id): RedirectResponse
    {
        $user = $this->getManagedUserById($id);

        if (!$this->userAccountManager->approveVeterinaryRequest($user)) {
            $this->addFlash('warning', 'This veterinary request cannot be approved.');

            return $this->redirectToUserManagement();
        }

        $this->addFlash('success', sprintf('%s has been approved as a veterinaire.', $user->getFullName()));

        return $this->redirectToUserManagement();
    }

    #[Route('/admin/user/{id}/reject-vet', name: 'admin_user_reject_vet', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function rejectVeterinaryRequest(int $id): RedirectResponse
    {
        $user = $this->getManagedUserById($id);

        if (!$this->userAccountManager->rejectVeterinaryRequest($user)) {
            $this->addFlash('warning', 'This veterinary request cannot be rejected.');

            return $this->redirectToUserManagement();
        }

        $this->addFlash('success', sprintf('%s\'s veterinary request has been rejected.', $user->getFullName()));

        return $this->redirectToUserManagement();
    }

    public function deleteEntity(\Doctrine\ORM\EntityManagerInterface $entityManager, $entityInstance): void
    {
        $admin = $this->getAdminUser();

        if (!$this->userAccountManager->delete($admin, $entityInstance)) {
            $this->addFlash('warning', 'This user cannot be deleted. Administrators cannot delete themselves or the last admin account.');

            return;
        }

        $this->addFlash('success', sprintf('%s has been deleted.', $entityInstance->getFullName()));
    }

    private function getAdminUser(): User
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw new AccessDeniedException('Administrator account required.');
        }

        return $user;
    }

    private function getManagedUserById(int $id): User
    {
        $user = $this->userRepository->find($id);
        if (!$user instanceof User) {
            throw $this->createNotFoundException('User not found.');
        }

        return $user;
    }

    /**
     * @param AdminContext<User>|null $context
     */
    private function redirectToUserManagement(?AdminContext $context = null): RedirectResponse
    {
        $referrer = $context?->getReferrer();
        if (is_string($referrer) && '' !== trim($referrer)) {
            return $this->redirect($referrer);
        }

        $url = $this->adminUrlGenerator
            ->unsetAll()
            ->setController(self::class)
            ->setAction(Action::INDEX)
            ->generateUrl();

        return $this->redirect($url);
    }
}
