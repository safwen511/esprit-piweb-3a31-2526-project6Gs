<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Produit;
use App\Entity\User;
use App\Repository\PanierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart', methods: ['GET'])]
    public function index(PanierRepository $paniers): Response
    {
        $user = $this->getCurrentUser();

        return $this->render('cart/index.html.twig', [
            'cart_items' => $paniers->findCartItems($user),
            'cart_quantity' => $paniers->getCartQuantity($user),
            'cart_total' => $paniers->getCartTotal($user),
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function add(
        Produit $produit,
        PanierRepository $paniers,
        EntityManagerInterface $entityManager,
        Request $request,
    ): RedirectResponse {
        $user = $this->getCurrentUser();

        $item = $paniers->findOneByClientAndProduit($user, $produit);
        $currentQty = $item?->getQty() ?? 0;
        $stock = $produit->getStock();

        if ($stock <= 0 || $currentQty >= $stock) {
            $this->addFlash('error', 'You cannot add more than the available stock.');

            return $this->redirectBack($request);
        }

        if ($item === null) {
            $item = (new Panier())
                ->setProduit($produit)
                ->setClient($user);
            $entityManager->persist($item);
        }

        $this->syncCartItem($item, $produit, min($currentQty + 1, $stock));
        $entityManager->flush();

        $this->addFlash('success', 'Item added to the cart.');

        return $this->redirectBack($request);
    }

    #[Route('/cart/item/{id}/quantity', name: 'app_cart_update', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function update(
        Panier $panier,
        Request $request,
        EntityManagerInterface $entityManager,
    ): RedirectResponse {
        $user = $this->getCurrentUser();
        $this->ensureCurrentUserCart($panier, $user);

        $quantity = $request->request->getInt('qty', 1);
        $stock = $panier->getProduit()->getStock();

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

    #[Route('/cart/item/{id}/remove', name: 'app_cart_remove', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function remove(
        Panier $panier,
        EntityManagerInterface $entityManager,
    ): RedirectResponse {
        $user = $this->getCurrentUser();
        $this->ensureCurrentUserCart($panier, $user);

        $entityManager->remove($panier);
        $entityManager->flush();

        $this->addFlash('success', 'Item removed from the cart.');

        return $this->redirectToRoute('app_cart');
    }

    private function syncCartItem(Panier $panier, Produit $produit, int $quantity): void
    {
        $panier
            ->setProduit($produit)
            ->setTitle((string) $produit->getTitle())
            ->setQty($quantity)
            ->setTotalP(((float) $produit->getPrice()) * $quantity)
            ->setTotalt(((float) $produit->getTva()) * $quantity);
    }

    private function ensureCurrentUserCart(Panier $panier, User $user): void
    {
        if ($panier->getClientId() !== $user->getId()) {
            throw $this->createNotFoundException();
        }
    }

    private function getCurrentUser(): User
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('You need to sign in to access the cart.');
        }

        return $user;
    }

    private function redirectBack(Request $request): RedirectResponse
    {
        $target = $request->headers->get('referer');

        return $target !== null
            ? new RedirectResponse($target)
            : $this->redirectToRoute('app_shop');
    }
}
