<?php

namespace App\Controller;

use App\Entity\AdoptionRequest;
use App\Entity\Animal;
use App\Form\AdoptionRequestType;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AnimalController extends AbstractController
{
    private string $imagesDirectory = 'assets/images';

    private const CATEGORY_ICONS = [
        'dog' => 'fa-dog',
        'cat' => 'fa-cat',
        'bird' => 'fa-dove',
        'fish' => 'fa-fish',
        'rabbit' => 'fa-carrot',
        'hamster' => 'fa-paw',
        'horse' => 'fa-horse',
        'turtle' => 'fa-fish-fins',
        'reptiles' => 'fa-dragon',
    ];

    private const DEFAULT_CATEGORIES = [
        'dog',
        'cat',
        'bird',
        'rabbit',
        'fish',
        'reptiles',
    ];

    private const FILTER_STATUSES = [
        'available',
        'pending',
        'adopted',
    ];

    private const FILTER_GENDERS = [
        'male',
        'female',
    ];

    private const FILTER_AGE_UNITS = [
        'months',
        'years',
    ];

    private function buildLayoutContext(UserRepository $userRepository, Request $request, array $context = []): array
    {
        return array_merge([
            'users' => $userRepository->findAll(),
            'currentUserId' => $request->getSession()->get('current_user_id'),
        ], $context);
    }

    private function handleImageUpload($imageFile, SluggerInterface $slugger): ?string
    {
        if (!$imageFile) {
            return null;
        }

        $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

        try {
            $imageFile->move(
                $this->getParameter('kernel.project_dir') . '/' . $this->imagesDirectory,
                $newFilename
            );
            return $newFilename;
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to upload image: ' . $e->getMessage());
        }
    }

    private function convertAgeToMonths(int $ageValue, string $ageUnit): int
    {
        return $ageUnit === 'years' ? $ageValue * 12 : $ageValue;
    }
    #[Route('/user/{userId}/animals', name: 'animal_index')]
    #[Route('/animals', name: 'animal_index_default')]
    public function index(?int $userId, AnimalRepository $animalRepository, UserRepository $userRepository, Request $request): Response
    {
        $session = $request->getSession();
        
        // If userId provided in URL, store in session
        if ($userId !== null) {
            $session->set('current_user_id', $userId);
        }
        
        // Get userId from session
        $currentUserId = $session->get('current_user_id');
        
        // If no current user, redirect or use first user
        if (!$currentUserId) {
            $firstUser = $userRepository->findOneBy([]);
            if ($firstUser) {
                $currentUserId = $firstUser->getId();
                $session->set('current_user_id', $currentUserId);
                return $this->redirectToRoute('animal_index', ['userId' => $currentUserId]);
            }
        }
        
        $currentUser = $currentUserId ? $userRepository->find($currentUserId) : null;
        $selectedCategory = trim((string) $request->query->get('category', ''));
        $normalizedCategory = $selectedCategory !== '' ? mb_strtolower($selectedCategory) : null;
        $minAge = $request->query->get('min_age');
        $maxAge = $request->query->get('max_age');
        $minAgeUnit = mb_strtolower(trim((string) $request->query->get('min_age_unit', 'months')));
        $maxAgeUnit = mb_strtolower(trim((string) $request->query->get('max_age_unit', 'months')));
        $selectedStatus = mb_strtolower(trim((string) $request->query->get('status', '')));
        $selectedGender = mb_strtolower(trim((string) $request->query->get('gender', '')));

        $minAgeUnit = in_array($minAgeUnit, self::FILTER_AGE_UNITS, true) ? $minAgeUnit : 'months';
        $maxAgeUnit = in_array($maxAgeUnit, self::FILTER_AGE_UNITS, true) ? $maxAgeUnit : 'months';

        $minAgeRawValue = $minAge !== null && $minAge !== '' ? max(0, (int) $minAge) : null;
        $maxAgeRawValue = $maxAge !== null && $maxAge !== '' ? max(0, (int) $maxAge) : null;
        $minAgeValue = $minAgeRawValue !== null ? $this->convertAgeToMonths($minAgeRawValue, $minAgeUnit) : null;
        $maxAgeValue = $maxAgeRawValue !== null ? $this->convertAgeToMonths($maxAgeRawValue, $maxAgeUnit) : null;
        $selectedStatus = in_array($selectedStatus, self::FILTER_STATUSES, true) ? $selectedStatus : '';
        $selectedGender = in_array($selectedGender, self::FILTER_GENDERS, true) ? $selectedGender : '';

        $animals = $animalRepository->findByFilters(
            $normalizedCategory,
            $minAgeValue,
            $maxAgeValue,
            $selectedStatus !== '' ? $selectedStatus : null,
            $selectedGender !== '' ? $selectedGender : null,
        );

        $databaseCategories = $animalRepository->findDistinctSpecies();
        $categoriesMap = [];

        foreach (self::DEFAULT_CATEGORIES as $categoryValue) {
            $categoriesMap[$categoryValue] = [
                'value' => $categoryValue,
                'label' => ucfirst($categoryValue),
                'icon' => self::CATEGORY_ICONS[$categoryValue] ?? 'fa-paw',
            ];
        }

        foreach ($databaseCategories as $category) {
            $value = $category['value'];
            $categoriesMap[$value] = [
                'value' => $value,
                'label' => $category['label'],
                'icon' => self::CATEGORY_ICONS[$value] ?? 'fa-paw',
            ];
        }

        $categories = array_values($categoriesMap);

        $favoriteIds = $session->get('favorite_animals', []);
        return $this->render('animal/index.html.twig', $this->buildLayoutContext($userRepository, $request, [
            'animals' => $animals,
            'currentUser' => $currentUser,
            'favoriteIds' => $favoriteIds,
            'categories' => $categories,
            'selectedCategory' => $normalizedCategory,
            'categoryRouteName' => $currentUserId ? 'animal_index' : 'animal_index_default',
            'filterValues' => [
                'min_age' => $minAgeRawValue,
                'max_age' => $maxAgeRawValue,
                'min_age_unit' => $minAgeUnit,
                'max_age_unit' => $maxAgeUnit,
                'status' => $selectedStatus,
                'gender' => $selectedGender,
            ],
        ]));
    }

    #[Route('/animals/show/{id}', name: 'animal_show')]
    public function show(Animal $animal, Request $request, UserRepository $userRepository): Response
    {
        return $this->render('animal/show.html.twig', $this->buildLayoutContext($userRepository, $request, [
            'animal' => $animal,
        ]));
    }

    #[Route('/animals/{id}/adopt', name: 'animal_adopt')]
    public function adopt(Animal $animal, Request $request, UserRepository $userRepository, EntityManagerInterface $em): Response
    {
        $session = $request->getSession();
        $userId = $session->get('current_user_id');

        if (!$userId) {
            $this->addFlash('error', 'flash.select_user_before_request');

            return $this->redirectToRoute('animal_index_default');
        }

        $user = $userRepository->find($userId);
        if (!$user) {
            throw $this->createNotFoundException('User not found.');
        }

        $adoptionRequest = new AdoptionRequest();
        $adoptionRequest->setAnimal($animal);
        $adoptionRequest->setClientId($user->getId());
        $adoptionRequest->setStatus('PENDING');

        $form = $this->createForm(AdoptionRequestType::class, $adoptionRequest, [
            'animal_id' => $animal->getId(),
            'client_id' => $user->getId(),
            'status' => 'PENDING',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($adoptionRequest);
            $em->flush();

            $this->addFlash('success', 'flash.adoption_request_sent');

            return $this->redirectToRoute('animal_index', ['userId' => $userId]);
        }

        return $this->render('adoption_request/new.html.twig', $this->buildLayoutContext($userRepository, $request, [
            'form' => $form->createView(),
            'animal' => $animal,
            'currentUser' => $user,
        ]));
    }

    #[Route('/animals/{id}/favorite/toggle', name: 'animal_toggle_favorite', methods: ['POST'])]
    public function toggleFavorite(Animal $animal, Request $request): JsonResponse
    {
        $session = $request->getSession();
        $favoriteIds = $session->get('favorite_animals', []);
        $animalId = $animal->getId();

        if (in_array($animalId, $favoriteIds, true)) {
            $favoriteIds = array_values(array_diff($favoriteIds, [$animalId]));
            $isFavorite = false;
        } else {
            $favoriteIds[] = $animalId;
            $isFavorite = true;
        }

        $session->set('favorite_animals', $favoriteIds);

        return $this->json(['favorite' => $isFavorite, 'id' => $animalId]);
    }

    #[Route('/animals/new', name: 'animal_new')]
    public function new(Request $request, UserRepository $userRepository, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $session = $request->getSession();
        $userId = $session->get('current_user_id');
        
        if (!$userId) {
            $this->addFlash('error', 'flash.no_user_selected');
            return $this->redirectToRoute('animal_index');
        }
        
        $user = $userRepository->find($userId);
        if (!$user) {
            throw $this->createNotFoundException('User not found.');
        }

        $animal = new Animal();
        $animal->setStatus('AVAILABLE');
        $animal->setOwner($user);

        $form = $this->createForm(AnimalType::class, $animal, [
            'age_value' => $animal->getAgeValueInput(),
            'age_unit' => $animal->getAgeUnitInput(),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ageInMonths = $this->convertAgeToMonths(
                (int) $form->get('ageValue')->getData(),
                (string) $form->get('ageUnit')->getData()
            );

            if ($ageInMonths > 300) {
                $form->get('ageValue')->addError(new FormError('Age cannot exceed 300 months.'));

                return $this->render('animal/new.html.twig', $this->buildLayoutContext($userRepository, $request, [
                    'form' => $form->createView(),
                    'user' => $user,
                ]));
            }

            $animal->setAge($ageInMonths);

            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $filename = $this->handleImageUpload($imageFile, $slugger);
                $animal->setImage($filename);
            }

            $em->persist($animal);
            $em->flush();

            $this->addFlash('success', 'flash.animal_added');
            return $this->redirectToRoute('animal_index', ['userId' => $userId]);
        }

        return $this->render('animal/new.html.twig', $this->buildLayoutContext($userRepository, $request, [
            'form' => $form->createView(),
            'user' => $user,
        ]));
    }

    #[Route('/animals/{id}/edit', name: 'animal_edit')]
    public function edit(Animal $animal, Request $request, UserRepository $userRepository, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $session = $request->getSession();
        $userId = $session->get('current_user_id');
        
        if (!$userId) {
            throw $this->createAccessDeniedException('No user selected.');
        }
        
        $user = $userRepository->find($userId);
        if (!$user || $animal->getOwner()?->getId() !== $user->getId()) {
            throw $this->createAccessDeniedException('You can only edit your own animals.');
        }

        $currentImage = $animal->getImage();

        $form = $this->createForm(AnimalType::class, $animal, [
            'age_value' => $animal->getAgeValueInput(),
            'age_unit' => $animal->getAgeUnitInput(),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ageInMonths = $this->convertAgeToMonths(
                (int) $form->get('ageValue')->getData(),
                (string) $form->get('ageUnit')->getData()
            );

            if ($ageInMonths > 300) {
                $form->get('ageValue')->addError(new FormError('Age cannot exceed 300 months.'));

                return $this->render('animal/edit.html.twig', $this->buildLayoutContext($userRepository, $request, [
                    'form' => $form->createView(),
                    'animal' => $animal,
                    'user' => $user,
                ]));
            }

            $animal->setAge($ageInMonths);

            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $filename = $this->handleImageUpload($imageFile, $slugger);
                $animal->setImage($filename);
            } else {
                $animal->setImage($currentImage);
            }

            $em->flush();

            $this->addFlash('success', 'flash.animal_updated');
            return $this->redirectToRoute('animal_show', ['id' => $animal->getId()]);
        }

        return $this->render('animal/edit.html.twig', $this->buildLayoutContext($userRepository, $request, [
            'form' => $form->createView(),
            'animal' => $animal,
            'user' => $user,
        ]));
    }

    #[Route('/animals/{id}/delete', name: 'animal_delete', methods: ['POST'])]
    public function delete(Animal $animal, Request $request, UserRepository $userRepository, EntityManagerInterface $em): RedirectResponse
    {
        $session = $request->getSession();
        $userId = $session->get('current_user_id');
        
        if (!$userId) {
            throw $this->createAccessDeniedException('No user selected.');
        }
        
        $user = $userRepository->find($userId);
        if (!$user || $animal->getOwner()?->getId() !== $user->getId()) {
            throw $this->createAccessDeniedException('You can only delete your own animals.');
        }

        if ($this->isCsrfTokenValid('delete-animal-' . $animal->getId(), $request->request->get('_token'))) {
            $em->remove($animal);
            $em->flush();
            $this->addFlash('success', 'flash.animal_deleted');
        }

        return $this->redirectToRoute('animal_my_animals', ['userId' => $userId]);
    }

    #[Route('/animals/{userId}', name: 'animal_my_animals')]
    public function myAnimals(int $userId, UserRepository $userRepository, AnimalRepository $animalRepository, Request $request): Response
    {
        $user = $userRepository->find($userId);
        if (!$user) {
            throw $this->createNotFoundException('User not found.');
        }

        $animals = $animalRepository->findByOwner($user);

        return $this->render('animal/my_animals.html.twig', $this->buildLayoutContext($userRepository, $request, [
            'animals' => $animals,
            'user' => $user,
        ]));
    }
}
