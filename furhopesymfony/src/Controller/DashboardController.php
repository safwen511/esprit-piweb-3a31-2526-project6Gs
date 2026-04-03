<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\DashboardViewBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractController
{
    public function __construct(private readonly DashboardViewBuilder $dashboardViewBuilder)
    {
    }

    #[Route('/dashboard', name: 'app_dashboard')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('dashboard/index.html.twig', $this->dashboardViewBuilder->build(
            $user,
            $this->isGranted('ROLE_ADMIN'),
        ));
    }
}
