<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\AdoptionRequestRepository;
use App\Repository\AnimalRepository;
use App\Repository\PanierRepository;
use App\Repository\ProduitRepository;
use App\Service\DashboardViewBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

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

    #[Route('/dashboard/animal-statistics', name: 'app_dashboard_animal_statistics')]
    public function animalStatistics(
        AnimalRepository $animalRepository,
        AdoptionRequestRepository $adoptionRequestRepository,
        ChartBuilderInterface $chartBuilder,
    ): Response {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_home');
        }

        $topRequestedAnimals = $animalRepository->findTopRequestedAnimals();
        $requestsPerAnimal = $animalRepository->countRequestsPerAnimal();
        $requestTrends = $adoptionRequestRepository->countDailyTrends(30);

        $topRequestedLabels = array_map(
            static fn (array $entry): string => $entry['animal']->getName() ?? 'Unknown',
            $topRequestedAnimals,
        );
        $topRequestedValues = array_map(
            static fn (array $entry): int => (int) $entry['totalRequests'],
            $topRequestedAnimals,
        );

        $requestsPerAnimalLabels = array_map(
            static fn (array $entry): string => $entry['animal']->getName() ?? 'Unknown',
            array_slice($requestsPerAnimal, 0, 10),
        );
        $requestsPerAnimalValues = array_map(
            static fn (array $entry): int => (int) $entry['totalRequests'],
            array_slice($requestsPerAnimal, 0, 10),
        );

        $trendLabels = array_map(
            static fn (array $entry): string => (new \DateTimeImmutable($entry['date']))->format('M d'),
            $requestTrends,
        );
        $trendValues = array_map(
            static fn (array $entry): int => (int) $entry['totalRequests'],
            $requestTrends,
        );

        $topRequestedChart = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $topRequestedChart->setData([
            'labels' => $topRequestedLabels,
            'datasets' => [[
                'label' => 'Top requested animals',
                'data' => $topRequestedValues,
                'backgroundColor' => ['#f25f4c', '#f7b32b', '#4d7ad6', '#7cc6bf', '#be5f2a'],
            ]],
        ]);
        $topRequestedChart->setOptions([
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => ['position' => 'bottom'],
            ],
        ]);

        $requestsPerAnimalChart = $chartBuilder->createChart(Chart::TYPE_BAR);
        $requestsPerAnimalChart->setData([
            'labels' => $requestsPerAnimalLabels,
            'datasets' => [[
                'label' => 'Adoption requests',
                'data' => $requestsPerAnimalValues,
                'backgroundColor' => '#f7b32b',
                'borderColor' => '#c95e2d',
                'borderWidth' => 1,
            ]],
        ]);
        $requestsPerAnimalChart->setOptions([
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => ['display' => false],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => ['precision' => 0],
                ],
            ],
        ]);

        $requestTrendChart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $requestTrendChart->setData([
            'labels' => $trendLabels,
            'datasets' => [[
                'label' => 'Requests per day',
                'data' => $trendValues,
                'borderColor' => '#f25f4c',
                'backgroundColor' => 'rgba(242, 95, 76, 0.15)',
                'fill' => true,
                'tension' => 0.32,
                'pointRadius' => 2,
            ]],
        ]);
        $requestTrendChart->setOptions([
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => ['display' => false],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => ['precision' => 0],
                ],
            ],
        ]);

        return $this->render('dashboard/animal_statistics.html.twig', array_merge(
            $this->dashboardViewBuilder->build($user, true),
            [
                'topRequestedAnimals' => $topRequestedAnimals,
                'neverRequestedAnimals' => $animalRepository->findNeverRequested(),
                'requestsPerAnimal' => $requestsPerAnimal,
                'topRequestedChart' => $topRequestedChart,
                'requestsPerAnimalChart' => $requestsPerAnimalChart,
                'requestTrendChart' => $requestTrendChart,
            ],
        ));
    }

    #[Route('/dashboard/product-statistics', name: 'app_dashboard_product_statistics')]
    public function productStatistics(
        ProduitRepository $produitRepository,
        PanierRepository $panierRepository,
        ChartBuilderInterface $chartBuilder
    ): Response {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_home');
        }

        // Category pie chart
        $categories = $produitRepository->findTopCategories();
        $categoryLabels = array_column($categories, 'category');
        $categoryValues = array_column($categories, 'total');


        $categoryChart = $chartBuilder->createChart(Chart::TYPE_PIE);
        $categoryChart->setData([
            'labels' => $categoryLabels,
            'datasets' => [[
                'data' => $categoryValues,
                'backgroundColor' => ['#f25f4c', '#f7b32b', '#4d7ad6', '#7cc6bf', '#be5f2a'],
            ]],
        ]);
        $categoryChart->setOptions([
            'maintainAspectRatio' => false,
        ]);

        $inventory = $produitRepository->findInventoryStats();
        $prices = $produitRepository->findPriceStats();
        $abandonmentStats = ['rate' => 0, 'totalCarts' => 0, 'abandonedCarts' => 0];



        return $this->render('dashboard/product_statistics.html.twig', array_merge(
            $this->dashboardViewBuilder->build($user, true),
            [
                'categoryChart' => $categoryChart,
                'inventory' => $inventory,
                'prices' => $prices,
                'abandonmentStats' => $abandonmentStats,
                'categories' => $categories,
            ]
        ));
    }
}

