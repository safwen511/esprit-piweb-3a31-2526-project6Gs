<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileFormType;
use App\Repository\FaceCredentialRepository;
use App\Service\ProfileImageUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    #[IsGranted('ROLE_USER')]
    public function show(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('profile/show.html.twig', [
            'member' => $user,
        ]);
    }

    #[Route('/profile/edit', name: 'app_profile_edit')]
    #[IsGranted('ROLE_USER')]
    public function edit(
        Request $request,
        EntityManagerInterface $entityManager,
        ProfileImageUploader $profileImageUploader,
        FaceCredentialRepository $faceCredentialRepository,
    ): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm(ProfileFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile|null $profileImage */
            $profileImage = $form->get('profileImage')->getData();

            if ($profileImage instanceof UploadedFile) {
                try {
                    $user->setProfileImageUrl($profileImageUploader->upload($profileImage));
                } catch (FileException) {
                    $this->addFlash('danger', 'The profile image could not be uploaded.');

                    return $this->redirectToRoute('app_profile_edit');
                }
            }

            $entityManager->flush();

            $this->addFlash('success', 'Your profile has been updated.');

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/edit.html.twig', [
            'member' => $user,
            'profileForm' => $form->createView(),
            'faceCredentials' => $faceCredentialRepository->findForUser($user),
        ]);
    }
}
