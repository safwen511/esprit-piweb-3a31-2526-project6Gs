<?php

declare(strict_types=1);

namespace App\Controller\Shopges;

use App\Entity\Shopges\Panier;
use App\Entity\Shopges\Produit;
use App\Entity\User;
use App\Repository\Shopges\PanierRepository;
use App\Service\Shopges\PromoCodeService;
use App\Service\Shopges\ShopCurrencyService;
use Doctrine\DBAL\Exception\TableNotFoundException;
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
    public function index(
        Request $request,
        PanierRepository $paniers,
        PromoCodeService $promoCodes,
        ShopCurrencyService $currencyService,
    ): Response
    {
        $user = $this->getCurrentUser();
        $cartItems = $paniers->findCartItems($user);
        $subtotal = $paniers->getCartTotal($user);
        $promo = null;

        try {
            $promo = $promoCodes->getAppliedPromo($request->getSession());
        } catch (TableNotFoundException|\Doctrine\DBAL\Exception $exception) {
            $this->addPromoMigrationWarning();
        }

        $pricing = $promoCodes->calculateSummary($subtotal, $promo);
        $currency = $currencyService->getCurrencyContext($request->getSession());
        $convertedItemTotals = [];

        foreach ($cartItems as $item) {
            $itemId = $item->getId();
            if ($itemId === null) {
                continue;
            }

            $convertedItemTotals[$itemId] = $currencyService->convertFromBase((float) $item->getLineTotal(), $currency['code']);
        }

        return $this->render('shopges/cart/index.html.twig', [
            'cart_items' => $cartItems,
            'cart_quantity' => $paniers->getCartQuantity($user),
            'cart_total' => $pricing['total'],
            'cart_subtotal' => $pricing['subtotal'],
            'cart_discount_amount' => $pricing['discount_amount'],
            'cart_discount_percentage' => $pricing['discount_percentage'],
            'applied_promo' => $pricing['promo'],
            'payment_currency' => $currency,
            'available_currencies' => $currencyService->getAvailableCurrencies(),
            'cart_total_converted' => $currencyService->convertFromBase($pricing['total'], $currency['code']),
            'cart_subtotal_converted' => $currencyService->convertFromBase($pricing['subtotal'], $currency['code']),
            'cart_discount_amount_converted' => $currencyService->convertFromBase($pricing['discount_amount'], $currency['code']),
            'cart_item_totals_converted' => $convertedItemTotals,
        ]);
    }

    #[Route('/cart/currency', name: 'app_cart_currency', methods: ['POST'])]
    public function updateCurrency(Request $request, ShopCurrencyService $currencyService): RedirectResponse
    {
        $currencyService->setSelectedCurrency($request->getSession(), (string) $request->request->get('currency', 'USD'));
        $this->addFlash('success', 'Payment currency updated.');

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/promo/apply', name: 'app_cart_promo_apply', methods: ['POST'])]
    public function applyPromo(
        Request $request,
        PanierRepository $paniers,
        PromoCodeService $promoCodes,
    ): RedirectResponse {
        $user = $this->getCurrentUser();
        $subtotal = $paniers->getCartTotal($user);

        try {
            $promo = $promoCodes->applyCode(
                $request->getSession(),
                (string) $request->request->get('code', ''),
                $subtotal,
            );

            $this->addFlash('success', sprintf(
                'Promo code %s applied. You now have %s%% off.',
                $promo->getCode(),
                number_format($promo->getDiscountPercentage(), 1)
            ));
        } catch (TableNotFoundException|\Doctrine\DBAL\Exception $exception) {
            $this->addPromoMigrationWarning();
        } catch (\RuntimeException $exception) {
            $this->addFlash('error', $exception->getMessage());
        }

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/promo/remove', name: 'app_cart_promo_remove', methods: ['POST'])]
    public function removePromo(Request $request, PromoCodeService $promoCodes): RedirectResponse
    {
        $promoCodes->clearAppliedCode($request->getSession());
        $this->addFlash('success', 'Promo code removed from the cart.');

        return $this->redirectToRoute('app_cart');
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
        int $id,
        Request $request,
        EntityManagerInterface $entityManager,
        PanierRepository $paniers,
    ): RedirectResponse {
        $user = $this->getCurrentUser();
        $panier = $paniers->find($id);
        if (!$panier instanceof Panier) {
            $this->addFlash('warning', 'Cart item was already updated.');

            return $this->redirectToRoute('app_cart');
        }

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
        int $id,
        EntityManagerInterface $entityManager,
        PanierRepository $paniers,
    ): RedirectResponse {
        $user = $this->getCurrentUser();
        $panier = $paniers->find($id);
        if (!$panier instanceof Panier) {
            $this->addFlash('warning', 'Cart item was already removed.');

            return $this->redirectToRoute('app_cart');
        }

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

    private function addPromoMigrationWarning(): void
    {
        $this->addFlash(
            'warning',
            'Promo codes are unavailable until the shared shop promo migrations are applied. Run: php bin/console doctrine:migrations:execute \'DoctrineMigrations\\Version20260417110000\' --up --no-interaction then php bin/console doctrine:migrations:execute \'DoctrineMigrations\\Version20260417123000\' --up --no-interaction'
        );
    }
}

