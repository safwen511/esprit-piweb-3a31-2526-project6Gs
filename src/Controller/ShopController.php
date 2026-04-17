<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\User;
use App\Repository\PanierRepository;
use App\Repository\ProduitRepository;
<<<<<<< HEAD
=======
use App\Service\CurrentShopUserService;
>>>>>>> origin/integrationv11
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
<<<<<<< HEAD
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[IsGranted('ROLE_USER')]
=======
use Symfony\Component\String\Slugger\SluggerInterface;

>>>>>>> origin/integrationv11
final class ShopController extends AbstractController
{
    private const PRODUCT_UPLOAD_DIR = 'public/uploads/products';

<<<<<<< HEAD
=======
    #[Route('/', name: 'app_shop_home', methods: ['GET'])]
>>>>>>> origin/integrationv11
    #[Route('/shop', name: 'app_shop', methods: ['GET'])]
    public function index(
        Request $request,
        ProduitRepository $produits,
        PanierRepository $paniers,
<<<<<<< HEAD
    ): Response {
        $user = $this->getCurrentUser();
=======
        CurrentShopUserService $currentShopUser
    ): Response {
        $user = $currentShopUser->getCurrentUser($request);
>>>>>>> origin/integrationv11
        $filters = [
            'q' => trim((string) $request->query->get('q', '')),
            'category' => strtolower(trim((string) $request->query->get('category', 'all'))),
            'min_price' => trim((string) $request->query->get('min_price', '')),
            'max_price' => trim((string) $request->query->get('max_price', '')),
        ];
        $products = $produits->searchForShop($filters);

        if ($request->isXmlHttpRequest()) {
            return $this->render('shop/_catalog.html.twig', [
                'products' => $products,
<<<<<<< HEAD
                'cart_quantities' => $paniers->getQuantitiesByProductId($user),
=======
                'cart_quantities' => $paniers->getQuantitiesByProductId((int) $user->getId()),
                'can_manage_products' => $user->isOwner(),
>>>>>>> origin/integrationv11
            ]);
        }

        return $this->render('shop/index.html.twig', [
            'products' => $products,
            'filters' => $filters,
            'categories' => $produits->getAvailableCategories(),
<<<<<<< HEAD
            'cart_quantity' => $paniers->getCartQuantity($user),
            'cart_quantities' => $paniers->getQuantitiesByProductId($user),
        ]);
    }

    #[Route('/dashboard/products', name: 'app_shop_management', methods: ['GET'])]
    public function management(
        ProduitRepository $produits,
        PanierRepository $paniers,
    ): Response {
        $user = $this->getCurrentUser();
        $isAdmin = $this->isGranted('ROLE_ADMIN');

        return $this->render('shop/management.html.twig', [
            'products' => $produits->findForManagement($user, $isAdmin),
            'current_user' => $user,
            'is_admin' => $isAdmin,
            'cart_quantity' => $paniers->getCartQuantity($user),
=======
            'cart_quantity' => $paniers->getCartQuantity((int) $user->getId()),
            'cart_quantities' => $paniers->getQuantitiesByProductId((int) $user->getId()),
            'current_user' => $user,
            'can_manage_products' => $user->isOwner(),
>>>>>>> origin/integrationv11
        ]);
    }

    #[Route('/shop/item/new', name: 'app_shop_item_new', methods: ['GET', 'POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager,
        PanierRepository $paniers,
        SluggerInterface $slugger,
<<<<<<< HEAD
    ): Response|RedirectResponse {
        $user = $this->getCurrentUser();
        $produit = new Produit();
        $produit->setOwner($user);
=======
        CurrentShopUserService $currentShopUser
    ): Response|RedirectResponse {
        $user = $currentShopUser->getCurrentUser($request);
        $this->denyUnlessOwner($user);

        $produit = new Produit();
>>>>>>> origin/integrationv11

        if ($request->isMethod('POST')) {
            $errors = $this->fillProduitFromRequest($produit, $request, $slugger);
            if ($errors === []) {
                $entityManager->persist($produit);
                $entityManager->flush();

<<<<<<< HEAD
                $this->addFlash('success', 'shop.flash.product_created');

                return $this->redirectToRoute('app_shop_management');
=======
                $this->addFlash('success', 'Product created successfully.');

                return $this->redirectToRoute('app_shop');
>>>>>>> origin/integrationv11
            }

            foreach ($errors as $error) {
                $this->addFlash('error', $error);
            }
        }

        return $this->render('shop/form.html.twig', [
            'product' => $produit,
            'categories' => Produit::allowedCategories(),
<<<<<<< HEAD
            'form_title' => 'shop.pages.add_product',
            'submit_label' => 'shop.actions.create',
            'cart_quantity' => $paniers->getCartQuantity($user),
            'back_path' => 'app_shop_management',
        ]);
    }

    #[Route('/shop/item/{id}/edit', name: 'app_shop_item_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
=======
            'form_title' => 'Add Product',
            'submit_label' => 'Create',
            'cart_quantity' => $paniers->getCartQuantity((int) $user->getId()),
            'current_user' => $user,
            'can_manage_products' => true,
        ]);
    }

    #[Route('/shop/item/{id}/edit', name: 'app_shop_item_edit', methods: ['GET', 'POST'])]
>>>>>>> origin/integrationv11
    public function edit(
        Produit $produit,
        Request $request,
        EntityManagerInterface $entityManager,
        PanierRepository $paniers,
        SluggerInterface $slugger,
<<<<<<< HEAD
    ): Response|RedirectResponse {
        $user = $this->getCurrentUser();
        $this->denyUnlessCanManageProduct($produit, $user);
=======
        CurrentShopUserService $currentShopUser
    ): Response|RedirectResponse {
        $user = $currentShopUser->getCurrentUser($request);
        $this->denyUnlessOwner($user);
>>>>>>> origin/integrationv11
        $previousImage = $produit->getImage();

        if ($request->isMethod('POST')) {
            $errors = $this->fillProduitFromRequest($produit, $request, $slugger);
            if ($errors === []) {
                $entityManager->flush();
                $this->deleteProjectImageIfReplaced($previousImage, $produit->getImage());

<<<<<<< HEAD
                $this->addFlash('success', 'shop.flash.product_updated');

                return $this->redirectToRoute('app_shop_management');
=======
                $this->addFlash('success', 'Product updated successfully.');

                return $this->redirectToRoute('app_shop');
>>>>>>> origin/integrationv11
            }

            foreach ($errors as $error) {
                $this->addFlash('error', $error);
            }
        }

        return $this->render('shop/form.html.twig', [
            'product' => $produit,
            'categories' => Produit::allowedCategories(),
<<<<<<< HEAD
            'form_title' => 'shop.pages.edit_product',
            'submit_label' => 'shop.actions.save',
            'cart_quantity' => $paniers->getCartQuantity($user),
            'back_path' => 'app_shop_management',
        ]);
    }

    #[Route('/shop/item/{id}/delete', name: 'app_shop_item_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(
        Produit $produit,
        EntityManagerInterface $entityManager,
    ): RedirectResponse {
        $this->denyUnlessCanManageProduct($produit, $this->getCurrentUser());
=======
            'form_title' => 'Edit Product',
            'submit_label' => 'Save',
            'cart_quantity' => $paniers->getCartQuantity((int) $user->getId()),
            'current_user' => $user,
            'can_manage_products' => true,
        ]);
    }

    #[Route('/shop/item/{id}/delete', name: 'app_shop_item_delete', methods: ['POST'])]
    public function delete(
        Produit $produit,
        EntityManagerInterface $entityManager,
        Request $request,
        CurrentShopUserService $currentShopUser
    ): RedirectResponse {
        $this->denyUnlessOwner($currentShopUser->getCurrentUser($request));
>>>>>>> origin/integrationv11
        $imagePath = $produit->getImage();

        $entityManager->remove($produit);
        $entityManager->flush();
        $this->deleteProjectImage($imagePath);

<<<<<<< HEAD
        $this->addFlash('success', 'shop.flash.product_deleted');

        return $this->redirectToRoute('app_shop_management');
=======
        $this->addFlash('success', 'Product deleted successfully.');

        return $this->redirectToRoute('app_shop');
>>>>>>> origin/integrationv11
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
<<<<<<< HEAD
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
=======
            $errors[] = 'Name is required.';
        }

        if (!is_numeric($price) || (float) $price < 0) {
            $errors[] = 'Price must be a positive number.';
        }

        if (!is_numeric($tva) || (float) $tva < 0) {
            $errors[] = 'TVA must be a positive number.';
        }

        if (!ctype_digit(ltrim($stock, '+')) || (int) $stock < 0) {
            $errors[] = 'Stock must be a positive integer.';
        }

        if (!array_key_exists($category, Produit::allowedCategories())) {
            $errors[] = 'Category must be selected from the dropdown.';
        }

        if ($uploadedImage !== null && !$uploadedImage->isValid()) {
            $errors[] = 'The uploaded image is not valid.';
>>>>>>> origin/integrationv11
        }

        if ($errors !== []) {
            return $errors;
        }

        if ($uploadedImage !== null) {
            $safeTitle = $slugger->slug($title !== '' ? $title : 'product')->lower()->toString();
            $extension = $uploadedImage->guessExtension() ?: $uploadedImage->getClientOriginalExtension() ?: 'bin';
            $filename = sprintf('%s-%s.%s', $safeTitle, bin2hex(random_bytes(6)), strtolower($extension));
<<<<<<< HEAD
            $uploadDirectory = $this->getParameter('kernel.project_dir').DIRECTORY_SEPARATOR.self::PRODUCT_UPLOAD_DIR;
=======
            $uploadDirectory = $this->getParameter('kernel.project_dir') . DIRECTORY_SEPARATOR . self::PRODUCT_UPLOAD_DIR;
>>>>>>> origin/integrationv11

            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0777, true);
            }

            $uploadedImage->move($uploadDirectory, $filename);
<<<<<<< HEAD
            $produit->setImage('uploads/products/'.$filename);
=======
            $produit->setImage('uploads/products/' . $filename);
>>>>>>> origin/integrationv11
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

<<<<<<< HEAD
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
=======
    private function denyUnlessOwner(User $user): void
    {
        if (!$user->isOwner()) {
            throw $this->createAccessDeniedException('Only the owner can manage products.');
>>>>>>> origin/integrationv11
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

<<<<<<< HEAD
        $fullPath = $this->getParameter('kernel.project_dir').DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $imagePath);
=======
        $fullPath = $this->getParameter('kernel.project_dir') . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $imagePath);
>>>>>>> origin/integrationv11

        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }
}
