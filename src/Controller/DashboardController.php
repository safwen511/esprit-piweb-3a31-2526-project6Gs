<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\DashboardViewBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    public function __construct(private readonly DashboardViewBuilder $dashboardViewBuilder)
    {
    }

    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('dashboard/index.html.twig', $this->dashboardViewBuilder->build(
            $user,
            true,
        ));
    }
}
