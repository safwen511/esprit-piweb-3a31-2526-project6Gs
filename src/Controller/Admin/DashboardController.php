<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_dashboard');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FurHope Admin Tools');
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('styles/admin-theme.css');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToRoute('Public site', 'fa fa-home', 'app_home'),
            MenuItem::linkToRoute('Unified dashboard', 'fa fa-gauge', 'app_dashboard'),
            MenuItem::section('User management'),
            MenuItem::linkTo(UserCrudController::class, 'Check users', 'fa fa-users'),
        ];
    }
}
