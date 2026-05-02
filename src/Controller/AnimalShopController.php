<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\AdoptionRequest;
use App\Entity\Animal;
use App\Entity\User;
use App\Form\AdoptionRequestType;
use App\Form\AnimalType;
use App\Repository\AdoptionRequestRepository;
use App\Repository\AnimalRepository;
use App\Service\AnimalImagePredictionService;
use App\Service\AnimalRecommendationService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[IsGranted('ROLE_USER')]
#[Route('/animal-shop', name: 'animal_shop_')]
final class AnimalShopController extends AbstractController
{
    private const UPLOAD_DIR = 'public/uploads/animals';

    private const CATEGORY_SYMBOLS = [
        'dog' => 'D',
        'cat' => 'C',
        'bird' => 'B',
        'fish' => 'F',
        'rabbit' => 'R',
        'hamster' => 'H',
        'horse' => 'H',
        'turtle' => 'T',
        'reptiles' => 'R',
    ];

    private const DEFAULT_CATEGORIES = ['dog', 'cat', 'bird', 'rabbit', 'fish', 'reptiles'];
    private const FILTER_STATUSES = ['available', 'adopted'];
    private const FILTER_GENDERS = ['male', 'female'];
    private const FILTER_AGE_UNITS = ['months', 'years'];

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(
        AnimalRepository $animalRepository,
        AdoptionRequestRepository $adoptionRequestRepository,
        AnimalRecommendationService $animalRecommendationService,
        Request $request,
        PaginatorInterface $paginator,
    ): Response
    {
        $selectedCategory = trim((string) $request->query->get('category', ''));
        $normalizedCategory = $selectedCategory !== '' ? mb_strtolower($selectedCategory) : null;
        $minAge = $request->query->get('min_age');
        $maxAge = $request->query->get('max_age');
        $minAgeUnit = mb_strtolower(trim((string) $request->query->get('min_age_unit', 'months')));
        $maxAgeUnit = mb_strtolower(trim((string) $request->query->get('max_age_unit', 'months')));
        $selectedStatus = mb_strtolower(trim((string) $request->query->get('status', '')));
        $selectedGender = mb_strtolower(trim((string) $request->query->get('gender', '')));
        $preferredType = trim((string) $request->query->get('pref_type', ''));
        $preferredAgeBucket = trim((string) $request->query->get('pref_age_bucket', ''));
        $preferredGender = trim((string) $request->query->get('pref_gender', ''));
        $preferredTraits = trim((string) $request->query->get('pref_traits', ''));

        $minAgeUnit = in_array($minAgeUnit, self::FILTER_AGE_UNITS, true) ? $minAgeUnit : 'months';
        $maxAgeUnit = in_array($maxAgeUnit, self::FILTER_AGE_UNITS, true) ? $maxAgeUnit : 'months';

        $minAgeRawValue = $minAge !== null && $minAge !== '' ? max(0, (int) $minAge) : null;
        $maxAgeRawValue = $maxAge !== null && $maxAge !== '' ? max(0, (int) $maxAge) : null;
        $minAgeValue = $minAgeRawValue !== null ? $this->convertAgeToMonths($minAgeRawValue, $minAgeUnit) : null;
        $maxAgeValue = $maxAgeRawValue !== null ? $this->convertAgeToMonths($maxAgeRawValue, $maxAgeUnit) : null;
        $selectedStatus = in_array($selectedStatus, self::FILTER_STATUSES, true) ? $selectedStatus : '';
        $selectedGender = in_array($selectedGender, self::FILTER_GENDERS, true) ? $selectedGender : '';
        $preferredAgeBucket = in_array(mb_strtolower($preferredAgeBucket), ['baby', 'young', 'adult', 'senior'], true)
            ? mb_strtolower($preferredAgeBucket)
            : '';
        $preferredGender = in_array(mb_strtolower($preferredGender), self::FILTER_GENDERS, true)
            ? mb_strtolower($preferredGender)
            : '';

        $animals = $animalRepository->findByFilters(
            $normalizedCategory,
            $minAgeValue,
            $maxAgeValue,
            $selectedStatus !== '' ? $selectedStatus : null,
            $selectedGender !== '' ? $selectedGender : null,
        );
        $paginatedAnimals = $paginator->paginate(
            $animals,
            $request->query->getInt('page', 1),
            9
        );
        $recommendationPool = $animalRepository->findByFilters(
            null,
            null,
            null,
            'available',
            null,
        );
        $requestCountByAnimalId = [];
        foreach ($adoptionRequestRepository->countRequestsPerAnimal() as $entry) {
            $animal = $entry['animal'];
            if ($animal->getId() !== null) {
                $requestCountByAnimalId[(int) $animal->getId()] = $entry['totalRequests'];
            }
        }

        $recommendationPreferences = [
            'pref_type' => $preferredType,
            'pref_age_bucket' => $preferredAgeBucket,
            'pref_gender' => $preferredGender,
            'pref_traits' => $preferredTraits,
        ];
        $hasRecommendationInput = array_filter($recommendationPreferences, static fn (string $value): bool => trim($value) !== '') !== [];
        $recommendedAnimals = $animalRecommendationService->recommend(
            $recommendationPool,
            $preferredType !== '' ? $preferredType : null,
            $preferredAgeBucket !== '' ? $preferredAgeBucket : null,
            $preferredGender !== '' ? mb_strtoupper($preferredGender) : null,
            $preferredTraits !== '' ? $preferredTraits : null,
            $requestCountByAnimalId,
            6,
        );

        $databaseCategories = $animalRepository->findDistinctSpecies();
        $categoriesMap = [];

        foreach (self::DEFAULT_CATEGORIES as $categoryValue) {
            $categoriesMap[$categoryValue] = [
                'value' => $categoryValue,
                'label' => ucfirst($categoryValue),
                'symbol' => self::CATEGORY_SYMBOLS[$categoryValue],
            ];
        }

        foreach ($databaseCategories as $category) {
            $value = $category['value'];
            $categoriesMap[$value] = [
                'value' => $value,
                'label' => $category['label'],
                'symbol' => self::CATEGORY_SYMBOLS[$value] ?? mb_strtoupper(mb_substr($category['label'], 0, 1)),
            ];
        }

        return $this->render('animal/index.html.twig', [
            'animals' => $paginatedAnimals,
            'favoriteIds' => $request->getSession()->get('favorite_animals', []),
            'categories' => array_values($categoriesMap),
            'selectedCategory' => $normalizedCategory,
            'notificationCount' => $adoptionRequestRepository->countPendingForOwner((int) $this->getCurrentUser()->getId()),
            'filterValues' => [
                'min_age' => $minAgeRawValue,
                'max_age' => $maxAgeRawValue,
                'min_age_unit' => $minAgeUnit,
                'max_age_unit' => $maxAgeUnit,
                'status' => $selectedStatus,
                'gender' => $selectedGender,
            ],
            'recommendedAnimals' => $recommendedAnimals,
            'recommendationValues' => $recommendationPreferences,
            'hasRecommendationInput' => $hasRecommendationInput,
        ]);
    }

    #[Route('/animals/{id}', name: 'show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Animal $animal, AdoptionRequestRepository $adoptionRequestRepository): Response
    {
        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
            'notificationCount' => $adoptionRequestRepository->countPendingForOwner((int) $this->getCurrentUser()->getId()),
        ]);
    }

    #[Route('/animals/{id}/adopt', name: 'adopt', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function adopt(Animal $animal, Request $request, EntityManagerInterface $entityManager, AdoptionRequestRepository $adoptionRequestRepository): Response
    {
        $user = $this->getCurrentUser();
        $currentStatus = mb_strtolower(trim((string) $animal->getStatus()));
        if ($currentStatus !== 'available') {
            $this->addFlash('warning', 'This animal is no longer available for adoption.');

            return $this->redirectToRoute('animal_shop_show', ['id' => $animal->getId()]);
        }

        $adoptionRequest = new AdoptionRequest();
        $adoptionRequest->setAnimal($animal);
        $adoptionRequest->setClientId((int) $user->getId());
        $adoptionRequest->setStatus('PENDING');
        $adoptionRequest->setRequestDate(new \DateTime());

        $form = $this->createForm(AdoptionRequestType::class, $adoptionRequest, [
            'animal_id' => $animal->getId(),
            'client_id' => $user->getId(),
            'status' => 'PENDING',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($adoptionRequest);
            $entityManager->flush();
            $this->addFlash('success', 'pet_home.flash.request_sent');

            return $this->redirectToRoute('animal_shop_index');
        }

        return $this->render('adoption_request/new.html.twig', [
            'form' => $form->createView(),
            'animal' => $animal,
            'currentUser' => $user,
            'notificationCount' => $adoptionRequestRepository->countPendingForOwner((int) $user->getId()),
        ]);
    }

    #[Route('/animals/{id}/favorite/toggle', name: 'toggle_favorite', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function toggleFavorite(Animal $animal, Request $request): JsonResponse
    {
        $session = $request->getSession();
        $favoriteIds = $session->get('favorite_animals', []);
        $animalId = $animal->getId();

        if ($animalId !== null && in_array($animalId, $favoriteIds, true)) {
            $favoriteIds = array_values(array_diff($favoriteIds, [$animalId]));
            $isFavorite = false;
        } else {
            if ($animalId !== null) {
                $favoriteIds[] = $animalId;
            }
            $isFavorite = true;
        }

        $session->set('favorite_animals', $favoriteIds);

        return $this->json(['favorite' => $isFavorite, 'id' => $animalId]);
    }

    #[Route('/animals/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger,
        AdoptionRequestRepository $adoptionRequestRepository
    ): Response
    {
        $user = $this->getCurrentUser();
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
                $form->get('ageValue')->addError(new FormError('pet_home.validation.age_max'));

                return $this->render('animal/new.html.twig', [
                    'form' => $form->createView(),
                    'notificationCount' => $adoptionRequestRepository->countPendingForOwner((int) $user->getId()),
                ]);
            }

            $animal->setAge($ageInMonths);
            $imageFile = $form->get('image')->getData();

            if ($imageFile instanceof UploadedFile) {
                $filename = $this->handleImageUpload($imageFile, $slugger);
                $animal->setImage('uploads/animals/'.$filename);
            }

            $entityManager->persist($animal);
            $entityManager->flush();
            $this->addFlash('success', 'pet_home.flash.animal_added');

            return $this->redirectToRoute('animal_shop_index');
        }

        return $this->render('animal/new.html.twig', [
            'form' => $form->createView(),
            'notificationCount' => $adoptionRequestRepository->countPendingForOwner((int) $user->getId()),
        ]);
    }

    #[Route('/animals/predict-species-breed', name: 'predict_species_breed', methods: ['POST'])]
    public function predictSpeciesBreed(Request $request, AnimalImagePredictionService $predictionService): JsonResponse
    {
        $token = (string) $request->request->get('_token', '');
        if (!$this->isCsrfTokenValid('animal_predict_species_breed', $token)) {
            return $this->json([
                'success' => false,
                'message' => 'Invalid prediction request token.',
            ], 403);
        }

        $image = $request->files->get('image');
        if (!$image instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
            return $this->json([
                'success' => false,
                'message' => 'Please upload an image before running detection.',
            ], 422);
        }

        try {
            $prediction = $predictionService->predictFromUpload($image);
        } catch (\Throwable $exception) {
            return $this->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 422);
        }

        return $this->json([
            'success' => true,
            'prediction' => $prediction,
        ]);
    }

    #[Route('/animals/generate-description', name: 'generate_description', methods: ['POST'])]
    public function generateDescription(Request $request, AnimalImagePredictionService $predictionService): JsonResponse
    {
        $token = (string) $request->request->get('_token', '');
        if (!$this->isCsrfTokenValid('animal_generate_description', $token)) {
            return $this->json([
                'success' => false,
                'message' => 'Invalid description generation token.',
            ], 403);
        }

        $context = [
            'name' => (string) $request->request->get('name', ''),
            'species' => (string) $request->request->get('species', ''),
            'breed' => (string) $request->request->get('breed', ''),
            'age_value' => (string) $request->request->get('age_value', ''),
            'age_unit' => (string) $request->request->get('age_unit', 'months'),
            'gender' => (string) $request->request->get('gender', ''),
        ];

        $image = $request->files->get('image');
        $uploadedFile = $image instanceof \Symfony\Component\HttpFoundation\File\UploadedFile ? $image : null;

        try {
            $generated = $predictionService->generateDescription($context, $uploadedFile);
        } catch (\Throwable $exception) {
            return $this->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 422);
        }

        return $this->json([
            'success' => true,
            'generated' => $generated,
        ]);
    }

    #[Route('/animals/{id}/edit', name: 'edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(
        Animal $animal,
        Request $request,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger,
        AdoptionRequestRepository $adoptionRequestRepository
    ): Response
    {
        $user = $this->getCurrentUser();

        if ($animal->getOwner()?->getId() !== $user->getId()) {
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
                $form->get('ageValue')->addError(new FormError('pet_home.validation.age_max'));

                return $this->render('animal/edit.html.twig', [
                    'form' => $form->createView(),
                    'animal' => $animal,
                    'notificationCount' => $adoptionRequestRepository->countPendingForOwner((int) $user->getId()),
                ]);
            }

            $animal->setAge($ageInMonths);
            $imageFile = $form->get('image')->getData();

            if ($imageFile instanceof UploadedFile) {
                $filename = $this->handleImageUpload($imageFile, $slugger);
                $animal->setImage('uploads/animals/'.$filename);
            } else {
                $animal->setImage($currentImage);
            }

            $entityManager->flush();
            $this->addFlash('success', 'pet_home.flash.animal_updated');

            return $this->redirectToRoute('animal_shop_index');
        }

        return $this->render('animal/edit.html.twig', [
            'form' => $form->createView(),
            'animal' => $animal,
            'notificationCount' => $adoptionRequestRepository->countPendingForOwner((int) $user->getId()),
        ]);
    }

    #[Route('/animals/{id}/delete', name: 'delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(Animal $animal, Request $request, EntityManagerInterface $entityManager): RedirectResponse
    {
        $user = $this->getCurrentUser();

        if ($animal->getOwner()?->getId() !== $user->getId()) {
            throw $this->createAccessDeniedException('You can only delete your own animals.');
        }

        if ($this->isCsrfTokenValid('delete-animal-'.$animal->getId(), (string) $request->request->get('_token'))) {
            $entityManager->remove($animal);
            $entityManager->flush();
            $this->addFlash('success', 'pet_home.flash.animal_deleted');
        }

        return $this->redirectToRoute('animal_shop_my_animals');
    }

    #[Route('/my-animals', name: 'my_animals', methods: ['GET'])]
    public function myAnimals(
        AnimalRepository $animalRepository,
        AdoptionRequestRepository $adoptionRequestRepository,
        Request $request,
        PaginatorInterface $paginator,
    ): Response
    {
        $user = $this->getCurrentUser();
        $myAnimals = $animalRepository->findByOwner($user);
        $paginatedMyAnimals = $paginator->paginate(
            $myAnimals,
            $request->query->getInt('page', 1),
            8
        );

        return $this->render('animal/my_animals.html.twig', [
            'animals' => $paginatedMyAnimals,
            'user' => $user,
            'notificationCount' => $adoptionRequestRepository->countPendingForOwner((int) $user->getId()),
        ]);
    }

    private function convertAgeToMonths(int $ageValue, string $ageUnit): int
    {
        return $ageUnit === 'years' ? $ageValue * 12 : $ageValue;
    }

    private function getCurrentUser(): User
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('You need to sign in to access the animal shop.');
        }

        return $user;
    }

    private function handleImageUpload(UploadedFile $imageFile, SluggerInterface $slugger): string
    {
        $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename !== '' ? $originalFilename : 'animal')->lower()->toString();
        $newFilename = $safeFilename.'-'.bin2hex(random_bytes(6)).'.'.($imageFile->guessExtension() ?: 'jpg');
        $projectDir = $this->getParameter('kernel.project_dir');
        if (!is_string($projectDir)) {
            throw new \LogicException('The project directory parameter must be a string.');
        }

        $uploadDirectory = $projectDir.DIRECTORY_SEPARATOR.self::UPLOAD_DIR;

        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $imageFile->move($uploadDirectory, $newFilename);

        return $newFilename;
    }
}
