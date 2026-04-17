<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\User;
use App\Form\HotelType;
use App\Repository\HotelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin/pet-hotels', name: 'app_hotel_')]
final class HotelController extends AbstractController
{
    public function __construct(
        private readonly TranslatorInterface $translator,
    ) {
    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(HotelRepository $hotelRepository): Response
    {
        return $this->render('hotel/index.html.twig', [
            'hotels' => $hotelRepository->findAllOrdered(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response|RedirectResponse
    {
        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hotel->setManager($this->getCurrentUser());
            $entityManager->persist($hotel);
            $entityManager->flush();

            $this->addFlash('success', 'hotel_page.flash.hotel_created');

            return $this->redirectToRoute('app_hotel_index');
        }

        return $this->render('hotel/form.html.twig', [
            'hotel' => $hotel,
            'form' => $form->createView(),
            'pageTitle' => 'hotel_page.form.add_title',
            'submitLabel' => 'hotel_page.form.submit_create',
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Request $request, Hotel $hotel, EntityManagerInterface $entityManager): Response|RedirectResponse
    {
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$hotel->getManager() instanceof User) {
                $hotel->setManager($this->getCurrentUser());
            }

            $entityManager->flush();
            $this->addFlash('success', 'hotel_page.flash.hotel_updated');

            return $this->redirectToRoute('app_hotel_index');
        }

        return $this->render('hotel/form.html.twig', [
            'hotel' => $hotel,
            'form' => $form->createView(),
            'pageTitle' => 'hotel_page.form.edit_title',
            'submitLabel' => 'hotel_page.form.submit_save',
        ]);
    }

    private function getCurrentUser(): User
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException($this->translator->trans('hotel_page.access.manage_hotels'));
        }

        return $user;
    }
}
