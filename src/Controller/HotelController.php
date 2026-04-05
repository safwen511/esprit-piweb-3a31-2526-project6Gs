<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\HotelType;
use App\Repository\HotelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/hotel')]
final class HotelController extends AbstractController
{
    #[Route(name: 'app_hotel_index', methods: ['GET'])]
    public function index(HotelRepository $hotelRepository): Response
    {
        return $this->render('hotel/index.html.twig', [
            'hotels' => $hotelRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hotel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($hotel);
            $entityManager->flush();

            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hotel/new.html.twig', [
            'hotel' => $hotel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hotel_show', methods: ['GET'])]
    public function show(int $id, HotelRepository $hotelRepository): Response
    {
        $hotel = $hotelRepository->find($id);
        
        if (!$hotel) {
            throw $this->createNotFoundException('Hotel not found');
        }
        
        return $this->render('hotel/show.html.twig', [
            'hotel' => $hotel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hotel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id, HotelRepository $hotelRepository, EntityManagerInterface $entityManager): Response
    {
        $hotel = $hotelRepository->find($id);
        
        if (!$hotel) {
            throw $this->createNotFoundException('Hotel not found');
        }
        
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hotel/edit.html.twig', [
            'hotel' => $hotel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hotel_delete', methods: ['POST'])]
    public function delete(Request $request, int $id, HotelRepository $hotelRepository, EntityManagerInterface $entityManager): Response
    {
        $hotel = $hotelRepository->find($id);
        
        if (!$hotel) {
            throw $this->createNotFoundException('Hotel not found');
        }
        
        if ($this->isCsrfTokenValid('delete'.$hotel->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($hotel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/update', name: 'app_hotel_update', methods: ['POST'])]
    public function update(Request $request, int $id, HotelRepository $hotelRepository, EntityManagerInterface $entityManager): Response
    {
        $hotel = $hotelRepository->find($id);
        
        if (!$hotel) {
            throw $this->createNotFoundException('Hotel not found');
        }
        
        $hotel->setName($request->request->get('hotel')['name'] ?? $hotel->getName());
        $hotel->setAddress($request->request->get('hotel')['address'] ?? $hotel->getAddress());
        $hotel->setManagerId($request->request->get('hotel')['managerId'] ?? $hotel->getManagerId());
        $hotel->setCapacity($request->request->get('hotel')['capacity'] ?? $hotel->getCapacity());

        $entityManager->flush();

        return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
    }
}