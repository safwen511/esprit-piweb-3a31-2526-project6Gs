<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\AdoptionRequest;
use App\Entity\User;
use App\Form\MyAdoptionRequestType;
use App\Repository\AdoptionRequestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/animal-shop/my-requests', name: 'animal_shop_requests_')]
final class AnimalShopRequestController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(
        AdoptionRequestRepository $adoptionRequestRepository,
        Request $request,
        PaginatorInterface $paginator,
    ): Response
    {
        $user = $this->getCurrentUser();
        $requests = $adoptionRequestRepository->findForClient((int) $user->getId());
        $paginatedRequests = $paginator->paginate(
            $requests,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('my_request/index.html.twig', [
            'requests' => $paginatedRequests,
            'notificationCount' => $adoptionRequestRepository->countPendingForOwner((int) $user->getId()),
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request, AdoptionRequestRepository $adoptionRequestRepository, EntityManagerInterface $entityManager): Response
    {
        $adoptionRequest = $this->getPendingClientRequestOrFail($id, $adoptionRequestRepository);
        $form = $this->createForm(MyAdoptionRequestType::class, $adoptionRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'pet_home.flash.request_updated');

            return $this->redirectToRoute('animal_shop_requests_index');
        }

        return $this->render('my_request/edit.html.twig', [
            'requestItem' => $adoptionRequest,
            'form' => $form->createView(),
            'notificationCount' => $adoptionRequestRepository->countPendingForOwner((int) $this->getCurrentUser()->getId()),
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(int $id, Request $request, AdoptionRequestRepository $adoptionRequestRepository, EntityManagerInterface $entityManager): RedirectResponse
    {
        $adoptionRequest = $this->getPendingClientRequestOrFail($id, $adoptionRequestRepository);

        if (!$this->isCsrfTokenValid('my-request-delete-'.$adoptionRequest->getId(), (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'pet_home.flash.invalid_token');

            return $this->redirectToRoute('animal_shop_requests_index');
        }

        $entityManager->remove($adoptionRequest);
        $entityManager->flush();
        $this->addFlash('success', 'pet_home.flash.request_deleted');

        return $this->redirectToRoute('animal_shop_requests_index');
    }

    private function getCurrentUser(): User
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('You need to sign in to access your requests.');
        }

        return $user;
    }

    private function getPendingClientRequestOrFail(int $id, AdoptionRequestRepository $adoptionRequestRepository): AdoptionRequest
    {
        $user = $this->getCurrentUser();
        $adoptionRequest = $adoptionRequestRepository->findPendingForClient($id, (int) $user->getId());

        if (!$adoptionRequest instanceof AdoptionRequest) {
            throw $this->createNotFoundException('Pending adoption request not found.');
        }

        return $adoptionRequest;
    }
}
