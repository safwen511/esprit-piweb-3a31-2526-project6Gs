<?php

declare(strict_types=1);

namespace App\Controller\Shopges;

use App\Entity\Shopges\Produit;
use App\Entity\User;
use App\Repository\Shopges\PanierRepository;
use App\Repository\Shopges\ProduitRepository;
use App\Service\Shopges\ShopAiRecommendationService;
use App\Service\Shopges\ShopProductAnnouncementService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[IsGranted('ROLE_USER')]
final class ShopController extends AbstractController
{
    private const PRODUCT_UPLOAD_DIR = 'public/uploads/products';

    #[Route('/shop', name: 'app_shop', methods: ['GET'])]
    public function index(
        ProduitRepository $produits,
    ): Response {
        return $this->render('shopges/shop/index.html.twig', [
            'featured_products' => $produits->findRecentForShopHero(),
            'shop_ai_status' => [
                'manual_command' => 'powershell -ExecutionPolicy Bypass -File tools\\shopges_ai\\start.ps1',
            ],
            'shop_ai_csrf' => $this->container->get('security.csrf.token_manager')->getToken('shop_ai_recommend')->getValue(),
        ]);
    }

    #[Route('/shop/ai/recommend', name: 'app_shop_ai_recommend', methods: ['POST'])]
    public function recommendWithAi(
        Request $request,
        ProduitRepository $produits,
        ShopAiRecommendationService $shopAi,
    ): JsonResponse {
        $payload = json_decode($request->getContent(), true);
        if (!is_array($payload)) {
            return $this->json(['error' => 'Invalid request body.'], Response::HTTP_BAD_REQUEST);
        }

        if (!$this->isCsrfTokenValid('shop_ai_recommend', (string) ($payload['_token'] ?? ''))) {
            return $this->json(['error' => 'Invalid AI recommendation token.'], Response::HTTP_FORBIDDEN);
        }

        try {
            $recommendations = $shopAi->recommend(
                $produits->searchForShop([]),
                (string) ($payload['pet_type'] ?? ''),
                (string) ($payload['age'] ?? ''),
                (string) ($payload['symptoms_or_need'] ?? ''),
                isset($payload['budget']) && is_numeric($payload['budget']) ? (float) $payload['budget'] : null,
                (string) ($payload['preferred_category'] ?? ''),
                5,
            );
        } catch (\RuntimeException $exception) {
            return $this->json([
                'error' => $exception->getMessage(),
                'manual_command' => $shopAi->warmUp(false)['manual_command'],
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }

        return $this->json($recommendations);
    }

    #[Route('/shop/ai/describe', name: 'app_shop_ai_describe', methods: ['POST'])]
    public function describeWithAi(Request $request, ShopAiRecommendationService $shopAi): JsonResponse
    {
        if (!$this->isCsrfTokenValid('shop_ai_describe', (string) $request->request->get('_token', ''))) {
            return $this->json(['error' => 'Invalid AI description token.'], Response::HTTP_FORBIDDEN);
        }

        try {
            $description = $shopAi->generateDescription(
                (string) $request->request->get('title', ''),
                (string) $request->request->get('category', ''),
                is_numeric((string) $request->request->get('price', '')) ? (float) $request->request->get('price') : null,
                is_numeric((string) $request->request->get('tva', '')) ? (float) $request->request->get('tva') : null,
                ctype_digit(ltrim((string) $request->request->get('stock', ''), '+')) ? (int) $request->request->get('stock') : null,
                $request->files->get('image'),
                (string) $request->request->get('description', ''),
            );
        } catch (\RuntimeException $exception) {
            return $this->json([
                'error' => $exception->getMessage(),
                'manual_command' => $shopAi->warmUp(false)['manual_command'],
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }

        return $this->json($description);
    }

    #[Route('/dashboard/products', name: 'app_shop_management', methods: ['GET'])]
    public function management(
        Request $request,
        ProduitRepository $produits,
        PanierRepository $paniers,
        PaginatorInterface $paginator,
    ): Response {
        $user = $this->getCurrentUser();
        $isAdmin = $this->isGranted('ROLE_ADMIN');
        $pagination = $paginator->paginate(
            $produits->createManagementQueryBuilder($user, $isAdmin),
            max(1, $request->query->getInt('page', 1)),
            10,
        );

        return $this->render('shopges/shop/management.html.twig', [
            'products' => $pagination,
            'current_user' => $user,
            'is_admin' => $isAdmin,
            'cart_quantity' => $paniers->getCartQuantity($user),
        ]);
    }

    #[Route('/shop/item/new', name: 'app_shop_item_new', methods: ['GET', 'POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager,
        PanierRepository $paniers,
        SluggerInterface $slugger,
        ShopProductAnnouncementService $announcements,
    ): Response|RedirectResponse {
        $user = $this->getCurrentUser();
        $produit = new Produit();
        $produit->setOwner($user);

        if ($request->isMethod('POST')) {
            $errors = $this->fillProduitFromRequest($produit, $request, $slugger);
            if ($errors === []) {
                $entityManager->persist($produit);
                $entityManager->flush();

                $this->addFlash('success', 'shop.flash.product_created');

                try {
                    $announcementResult = $announcements->announceNewProduct($produit);
                    if ($announcementResult['sent'] > 0) {
                        $this->addFlash('success', sprintf(
                            'Announcement email sent to %d user%s.',
                            $announcementResult['sent'],
                            $announcementResult['sent'] > 1 ? 's' : ''
                        ));
                    }
                    if ($announcementResult['failed'] > 0) {
                        $this->addFlash('warning', sprintf(
                            '%d announcement email%s could not be delivered.',
                            $announcementResult['failed'],
                            $announcementResult['failed'] > 1 ? 's' : ''
                        ));
                    }
                } catch (\Throwable $exception) {
                    $this->addFlash('warning', 'Product created, but the announcement emails could not be sent.');
                }

                return $this->redirectToRoute('app_shop_management');
            }

            foreach ($errors as $error) {
                $this->addFlash('error', $error);
            }
        }

        return $this->render('shopges/shop/form.html.twig', [
            'product' => $produit,
            'categories' => Produit::allowedCategories(),
            'form_title' => 'shop.pages.add_product',
            'submit_label' => 'shop.actions.create',
            'cart_quantity' => $paniers->getCartQuantity($user),
            'back_path' => 'app_shop_management',
            'shop_ai_describe_url' => $this->generateUrl('app_shop_ai_describe'),
            'shop_ai_describe_csrf' => $this->container->get('security.csrf.token_manager')->getToken('shop_ai_describe')->getValue(),
        ]);
    }

    #[Route('/shop/item/{id}/edit', name: 'app_shop_item_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(
        Produit $produit,
        Request $request,
        EntityManagerInterface $entityManager,
        PanierRepository $paniers,
        SluggerInterface $slugger,
    ): Response|RedirectResponse {
        $user = $this->getCurrentUser();
        $this->denyUnlessCanManageProduct($produit, $user);
        $previousImage = $produit->getImage();

        if ($request->isMethod('POST')) {
            $errors = $this->fillProduitFromRequest($produit, $request, $slugger);
            if ($errors === []) {
                $entityManager->flush();
                $this->deleteProjectImageIfReplaced($previousImage, $produit->getImage());

                $this->addFlash('success', 'shop.flash.product_updated');

                return $this->redirectToRoute('app_shop_management');
            }

            foreach ($errors as $error) {
                $this->addFlash('error', $error);
            }
        }

        return $this->render('shopges/shop/form.html.twig', [
            'product' => $produit,
            'categories' => Produit::allowedCategories(),
            'form_title' => 'shop.pages.edit_product',
            'submit_label' => 'shop.actions.save',
            'cart_quantity' => $paniers->getCartQuantity($user),
            'back_path' => 'app_shop_management',
            'shop_ai_describe_url' => $this->generateUrl('app_shop_ai_describe'),
            'shop_ai_describe_csrf' => $this->container->get('security.csrf.token_manager')->getToken('shop_ai_describe')->getValue(),
        ]);
    }

    #[Route('/shop/item/{id}/delete', name: 'app_shop_item_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(
        Produit $produit,
        EntityManagerInterface $entityManager,
    ): RedirectResponse {
        $this->denyUnlessCanManageProduct($produit, $this->getCurrentUser());
        $imagePath = $produit->getImage();

        $entityManager->remove($produit);
        $entityManager->flush();
        $this->deleteProjectImage($imagePath);

        $this->addFlash('success', 'shop.flash.product_deleted');

        return $this->redirectToRoute('app_shop_management');
    }

    /**
     * @return list<string>
     */
    private function fillProduitFromRequest(Produit $produit, Request $request, SluggerInterface $slugger): array
    {
        $title = trim((string) $request->request->get('title', ''));
        $category = strtolower(trim((string) $request->request->get('category', 'medical')));
        $price = trim((string) $request->request->get('price', '0'));
        $tva = trim((string) $request->request->get('tva', '0'));
        $stock = trim((string) $request->request->get('stock', '0'));
        $description = trim((string) $request->request->get('description', ''));
        $uploadedImage = $request->files->get('image');

        $errors = [];

        if ($title === '') {
            $errors[] = 'shop.validation.name_required';
        }

        if (!is_numeric($price) || (float) $price < 0) {
            $errors[] = 'shop.validation.price_positive';
        }

        if (!is_numeric($tva) || (float) $tva < 0) {
            $errors[] = 'shop.validation.tva_positive';
        }

        if (!ctype_digit(ltrim($stock, '+')) || (int) $stock < 0) {
            $errors[] = 'shop.validation.stock_positive';
        }

        if (!array_key_exists($category, Produit::allowedCategories())) {
            $errors[] = 'shop.validation.category_required';
        }

        if ($uploadedImage !== null && !$uploadedImage->isValid()) {
            $errors[] = 'shop.validation.image_invalid';
        }

        if ($errors !== []) {
            return $errors;
        }

        if ($uploadedImage !== null) {
            $safeTitle = $slugger->slug($title !== '' ? $title : 'product')->lower()->toString();
            $extension = $uploadedImage->guessExtension() ?: $uploadedImage->getClientOriginalExtension() ?: 'bin';
            $filename = sprintf('%s-%s.%s', $safeTitle, bin2hex(random_bytes(6)), strtolower($extension));
            $uploadDirectory = $this->getParameter('kernel.project_dir').DIRECTORY_SEPARATOR.self::PRODUCT_UPLOAD_DIR;

            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0777, true);
            }

            $uploadedImage->move($uploadDirectory, $filename);
            $produit->setImage('uploads/products/'.$filename);
        }

        $produit
            ->setTitle($title)
            ->setCategory($category)
            ->setDescription($description)
            ->setPrice((float) $price)
            ->setTva((float) $tva)
            ->setStock((int) $stock);

        return [];
    }

    private function getCurrentUser(): User
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('shop.validation.access_sign_in');
        }

        return $user;
    }

    private function denyUnlessCanManageProduct(Produit $produit, User $user): void
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return;
        }

        if ($produit->getOwner()?->getId() !== $user->getId()) {
            throw $this->createAccessDeniedException('shop.validation.admin_only');
        }
    }

    private function deleteProjectImageIfReplaced(?string $previousImage, ?string $currentImage): void
    {
        if ($previousImage === null || $previousImage === $currentImage) {
            return;
        }

        $this->deleteProjectImage($previousImage);
    }

    private function deleteProjectImage(?string $imagePath): void
    {
        if ($imagePath === null || !str_starts_with($imagePath, 'uploads/products/')) {
            return;
        }

        $fullPath = $this->getParameter('kernel.project_dir').DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $imagePath);

        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }
}


