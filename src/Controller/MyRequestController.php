<?php

namespace App\Controller;

use App\Entity\AdoptionRequest;
use App\Form\MyAdoptionRequestType;
use App\Repository\AdoptionRequestRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyRequestController extends AbstractController
{
    private function buildLayoutContext(UserRepository $userRepository, Request $request, array $context = []): array
    {
        return array_merge([
            'users' => $userRepository->findAll(),
            'currentUserId' => $request->getSession()->get('current_user_id'),
        ], $context);
    }

    #[Route('/my-requests', name: 'my_requests_index')]
    public function index(Request $request, AdoptionRequestRepository $adoptionRequestRepository, UserRepository $userRepository): Response
    {
        $currentUserId = $request->getSession()->get('current_user_id');

        if (!$currentUserId) {
            $this->addFlash('error', 'flash.select_user_requests');

            return $this->redirectToRoute('animal_index_default');
        }

        return $this->render('my_request/index.html.twig', $this->buildLayoutContext($userRepository, $request, [
            'requests' => $adoptionRequestRepository->findForClient((int) $currentUserId),
        ]));
    }

    #[Route('/my-requests/{id}/edit', name: 'my_requests_edit')]
    public function edit(int $id, Request $request, AdoptionRequestRepository $adoptionRequestRepository, EntityManagerInterface $em, UserRepository $userRepository): Response
    {
        $adoptionRequest = $this->getPendingClientRequestOrFail($id, $request, $adoptionRequestRepository);

        $form = $this->createForm(MyAdoptionRequestType::class, $adoptionRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'flash.request_updated');

            return $this->redirectToRoute('my_requests_index');
        }

        return $this->render('my_request/edit.html.twig', $this->buildLayoutContext($userRepository, $request, [
            'requestItem' => $adoptionRequest,
            'form' => $form->createView(),
        ]));
    }

    #[Route('/my-requests/{id}/delete', name: 'my_requests_delete', methods: ['POST'])]
    public function delete(int $id, Request $request, AdoptionRequestRepository $adoptionRequestRepository, EntityManagerInterface $em): RedirectResponse
    {
        $adoptionRequest = $this->getPendingClientRequestOrFail($id, $request, $adoptionRequestRepository);

        if (!$this->isCsrfTokenValid('my-request-delete-' . $adoptionRequest->getId(), (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'flash.invalid_request_token');

            return $this->redirectToRoute('my_requests_index');
        }

        $em->remove($adoptionRequest);
        $em->flush();

        $this->addFlash('success', 'flash.request_deleted');

        return $this->redirectToRoute('my_requests_index');
    }

    private function getPendingClientRequestOrFail(int $id, Request $request, AdoptionRequestRepository $adoptionRequestRepository): AdoptionRequest
    {
        $currentUserId = $request->getSession()->get('current_user_id');
        if (!$currentUserId) {
            throw $this->createAccessDeniedException('No user selected.');
        }

        $adoptionRequest = $adoptionRequestRepository->findPendingForClient($id, (int) $currentUserId);
        if (!$adoptionRequest) {
            throw $this->createNotFoundException('Pending adoption request not found.');
        }

        return $adoptionRequest;
    }
}
