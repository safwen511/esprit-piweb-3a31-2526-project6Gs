<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Produit;
use App\Repository\PanierRepository;
use App\Service\CurrentShopUserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart', methods: ['GET'])]
    public function index(PanierRepository $paniers, Request $request, CurrentShopUserService $currentShopUser): Response
    {
        $user = $currentShopUser->getCurrentUser($request);

        return $this->render('cart/index.html.twig', [
            'cart_items' => $paniers->findCartItems((int) $user->getId()),
            'cart_quantity' => $paniers->getCartQuantity((int) $user->getId()),
            'cart_total' => $paniers->getCartTotal((int) $user->getId()),
            'current_user' => $user,
            'can_manage_products' => $user->isOwner(),
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add', methods: ['POST'])]
    public function add(
        Produit $produit,
        PanierRepository $paniers,
        EntityManagerInterface $entityManager,
        Request $request,
        CurrentShopUserService $currentShopUser
    ): RedirectResponse {
        $user = $currentShopUser->getCurrentUser($request);
        $userId = (int) $user->getId();

        $item = $paniers->findOneByClientAndProduit($userId, $produit);
        $currentQty = $item?->getQty() ?? 0;
        $stock = $produit->getStock() ?? 0;

        if ($stock <= 0 || $currentQty >= $stock) {
            $this->addFlash('error', 'You cannot add more than the available stock.');

            return $this->redirectBack($request);
        }

        if ($item === null) {
            $item = (new Panier())
                ->setProduit($produit)
                ->setClientId($userId);
            $entityManager->persist($item);
        }

        $this->syncCartItem($item, $produit, min($currentQty + 1, $stock));
        $entityManager->flush();

        $this->addFlash('success', 'Item added to the cart.');

        return $this->redirectBack($request);
    }

    #[Route('/cart/item/{id}/quantity', name: 'app_cart_update', methods: ['POST'])]
    public function update(
        Panier $panier,
        Request $request,
        EntityManagerInterface $entityManager,
        CurrentShopUserService $currentShopUser
    ): RedirectResponse {
        $user = $currentShopUser->getCurrentUser($request);
        $this->ensureCurrentUserCart($panier, (int) $user->getId());

        $quantity = $request->request->getInt('qty', 1);
        $stock = $panier->getProduit()?->getStock() ?? 0;

        if ($quantity <= 0) {
            $entityManager->remove($panier);
            $entityManager->flush();

            $this->addFlash('success', 'Item removed from the cart.');

            return $this->redirectToRoute('app_cart');
        }

        if ($quantity > $stock) {
            $quantity = $stock;
            $this->addFlash('error', 'Quantity adjusted to the available stock.');
        }

        $this->syncCartItem($panier, $panier->getProduit(), $quantity);
        $entityManager->flush();

        $this->addFlash('success', 'Cart updated.');

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/item/{id}/remove', name: 'app_cart_remove', methods: ['POST'])]
    public function remove(
        Panier $panier,
        EntityManagerInterface $entityManager,
        Request $request,
        CurrentShopUserService $currentShopUser
    ): RedirectResponse {
        $user = $currentShopUser->getCurrentUser($request);
        $this->ensureCurrentUserCart($panier, (int) $user->getId());

        $entityManager->remove($panier);
        $entityManager->flush();

        $this->addFlash('success', 'Item removed from the cart.');

        return $this->redirectToRoute('app_cart');
    }

    private function syncCartItem(Panier $panier, ?Produit $produit, int $quantity): void
    {
        if ($produit === null) {
            throw $this->createNotFoundException('Product not found for cart item.');
        }

        $panier
            ->setProduit($produit)
            ->setTitle((string) $produit->getTitle())
            ->setQty($quantity)
            ->setTotalP(((float) $produit->getPrice()) * $quantity)
            ->setTotalt(((float) $produit->getTva()) * $quantity);
    }

    private function ensureCurrentUserCart(Panier $panier, int $userId): void
    {
        if ($panier->getClientId() !== $userId) {
            throw $this->createNotFoundException();
        }
    }

    private function redirectBack(Request $request): RedirectResponse
    {
        $target = $request->headers->get('referer');

        return $target !== null
            ? new RedirectResponse($target)
            : $this->redirectToRoute('app_shop');
    }
}
