<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Service\UserAccountManager;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserCrudController extends AbstractCrudController
{
    public function __construct(private readonly UserAccountManager $userAccountManager)
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
            ->setHelp(Crud::PAGE_INDEX, 'Admins can edit, block, unblock, and delete members. Self-blocking and deleting the last admin are prevented.')
            ->setSearchFields(['email', 'firstName', 'lastName', 'phoneNumber'])
            ->setDefaultSort(['createdAt' => 'DESC'])
            ->setPaginatorPageSize(12);
    }

    public function configureActions(Actions $actions): Actions
    {
        $block = Action::new('blockUser', 'Block')
            ->linkToCrudAction('blockUser')
            ->setCssClass('btn btn-warning ea-action-toggle')
            ->displayIf(static fn (User $user) => $user->isActive());

        $unblock = Action::new('unblockUser', 'Unblock')
            ->linkToCrudAction('unblockUser')
            ->setCssClass('btn btn-success ea-action-toggle')
            ->displayIf(static fn (User $user) => !$user->isActive());

        return $actions
            ->add(Crud::PAGE_INDEX, $block)
            ->add(Crud::PAGE_DETAIL, $block)
            ->add(Crud::PAGE_INDEX, $unblock)
            ->add(Crud::PAGE_DETAIL, $unblock)
            ->update(Crud::PAGE_INDEX, Action::EDIT, static fn (Action $action) => $action->setLabel('Edit'))
            ->update(Crud::PAGE_INDEX, Action::DELETE, static fn (Action $action) => $action->setLabel('Delete'));
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('firstName', 'First name');
        yield TextField::new('lastName', 'Last name');
        yield EmailField::new('email');
        yield TextField::new('phoneNumber', 'Phone');
        yield ChoiceField::new('roles')
            ->allowMultipleChoices()
            ->setChoices([
                'Member' => 'ROLE_USER',
                'Admin' => 'ROLE_ADMIN',
                'Veterinaire' => 'ROLE_VETERINAIRE',
            ]);
        yield BooleanField::new('isVerified', 'Verified');
        yield BooleanField::new('isActive')->setLabel('Account active');
        yield BooleanField::new('isVeteranApplicant')->setLabel('Veterinaire request');
        yield BooleanField::new('isVeteranApproved')->setLabel('Veterinaire approved');
        yield TextField::new('createdAtLabel', 'Created at')->hideOnForm();
        yield TextField::new('updatedAtLabel', 'Updated at')->hideOnForm();
    }

    public function blockUser(AdminContext $context)
    {
        /** @var User $user */
        $user = $context->getEntity()->getInstance();
        $admin = $this->getAdminUser();

        if (!$this->userAccountManager->block($admin, $user)) {
            $this->addFlash('warning', 'This user cannot be blocked. Administrators cannot block themselves or the last active admin account.');

            return $this->redirect($context->getReferrer() ?: $this->generateUrl('admin_user_index'));
        }

        $this->addFlash('success', sprintf('%s has been blocked.', $user->getFullName()));

        return $this->redirect($context->getReferrer() ?: $this->generateUrl('admin_user_index'));
    }

    public function unblockUser(AdminContext $context)
    {
        /** @var User $user */
        $user = $context->getEntity()->getInstance();
        $admin = $this->getAdminUser();

        if (!$this->userAccountManager->unblock($admin, $user)) {
            $this->addFlash('warning', 'This user is already active.');

            return $this->redirect($context->getReferrer() ?: $this->generateUrl('admin_user_index'));
        }

        $this->addFlash('success', sprintf('%s has been unblocked.', $user->getFullName()));

        return $this->redirect($context->getReferrer() ?: $this->generateUrl('admin_user_index'));
    }

    public function deleteEntity(\Doctrine\ORM\EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof User) {
            parent::deleteEntity($entityManager, $entityInstance);

            return;
        }

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
}
