<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\User;
use App\Repository\PanierRepository;
use App\Repository\ProduitRepository;
use App\Service\CurrentShopUserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

final class ShopController extends AbstractController
{
    private const PRODUCT_UPLOAD_DIR = 'public/uploads/products';

    #[Route('/', name: 'app_shop_home', methods: ['GET'])]
    #[Route('/shop', name: 'app_shop', methods: ['GET'])]
    public function index(
        Request $request,
        ProduitRepository $produits,
        PanierRepository $paniers,
        CurrentShopUserService $currentShopUser
    ): Response {
        $user = $currentShopUser->getCurrentUser($request);
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
                'cart_quantities' => $paniers->getQuantitiesByProductId((int) $user->getId()),
                'can_manage_products' => $user->isOwner(),
            ]);
        }

        return $this->render('shop/index.html.twig', [
            'products' => $products,
            'filters' => $filters,
            'categories' => $produits->getAvailableCategories(),
            'cart_quantity' => $paniers->getCartQuantity((int) $user->getId()),
            'cart_quantities' => $paniers->getQuantitiesByProductId((int) $user->getId()),
            'current_user' => $user,
            'can_manage_products' => $user->isOwner(),
        ]);
    }

    #[Route('/shop/item/new', name: 'app_shop_item_new', methods: ['GET', 'POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager,
        PanierRepository $paniers,
        SluggerInterface $slugger,
        CurrentShopUserService $currentShopUser
    ): Response|RedirectResponse {
        $user = $currentShopUser->getCurrentUser($request);
        $this->denyUnlessOwner($user);

        $produit = new Produit();

        if ($request->isMethod('POST')) {
            $errors = $this->fillProduitFromRequest($produit, $request, $slugger);
            if ($errors === []) {
                $entityManager->persist($produit);
                $entityManager->flush();

                $this->addFlash('success', 'Product created successfully.');

                return $this->redirectToRoute('app_shop');
            }

            foreach ($errors as $error) {
                $this->addFlash('error', $error);
            }
        }

        return $this->render('shop/form.html.twig', [
            'product' => $produit,
            'categories' => Produit::allowedCategories(),
            'form_title' => 'Add Product',
            'submit_label' => 'Create',
            'cart_quantity' => $paniers->getCartQuantity((int) $user->getId()),
            'current_user' => $user,
            'can_manage_products' => true,
        ]);
    }

    #[Route('/shop/item/{id}/edit', name: 'app_shop_item_edit', methods: ['GET', 'POST'])]
    public function edit(
        Produit $produit,
        Request $request,
        EntityManagerInterface $entityManager,
        PanierRepository $paniers,
        SluggerInterface $slugger,
        CurrentShopUserService $currentShopUser
    ): Response|RedirectResponse {
        $user = $currentShopUser->getCurrentUser($request);
        $this->denyUnlessOwner($user);
        $previousImage = $produit->getImage();

        if ($request->isMethod('POST')) {
            $errors = $this->fillProduitFromRequest($produit, $request, $slugger);
            if ($errors === []) {
                $entityManager->flush();
                $this->deleteProjectImageIfReplaced($previousImage, $produit->getImage());

                $this->addFlash('success', 'Product updated successfully.');

                return $this->redirectToRoute('app_shop');
            }

            foreach ($errors as $error) {
                $this->addFlash('error', $error);
            }
        }

        return $this->render('shop/form.html.twig', [
            'product' => $produit,
            'categories' => Produit::allowedCategories(),
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
        $imagePath = $produit->getImage();

        $entityManager->remove($produit);
        $entityManager->flush();
        $this->deleteProjectImage($imagePath);

        $this->addFlash('success', 'Product deleted successfully.');

        return $this->redirectToRoute('app_shop');
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
        }

        if ($errors !== []) {
            return $errors;
        }

        if ($uploadedImage !== null) {
            $safeTitle = $slugger->slug($title !== '' ? $title : 'product')->lower()->toString();
            $extension = $uploadedImage->guessExtension() ?: $uploadedImage->getClientOriginalExtension() ?: 'bin';
            $filename = sprintf('%s-%s.%s', $safeTitle, bin2hex(random_bytes(6)), strtolower($extension));
            $uploadDirectory = $this->getParameter('kernel.project_dir') . DIRECTORY_SEPARATOR . self::PRODUCT_UPLOAD_DIR;

            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0777, true);
            }

            $uploadedImage->move($uploadDirectory, $filename);
            $produit->setImage('uploads/products/' . $filename);
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

    private function denyUnlessOwner(User $user): void
    {
        if (!$user->isOwner()) {
            throw $this->createAccessDeniedException('Only the owner can manage products.');
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

        $fullPath = $this->getParameter('kernel.project_dir') . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $imagePath);

        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }
}
