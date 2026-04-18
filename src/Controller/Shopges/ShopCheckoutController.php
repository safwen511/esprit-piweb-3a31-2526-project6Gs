<?php

declare(strict_types=1);

namespace App\Controller\Shopges;

use App\Entity\User;
use App\Repository\Shopges\PanierRepository;
use App\Service\Shopges\PromoCodeService;
use App\Service\Shopges\ShopCurrencyService;
use App\Service\Shopges\StripeCheckoutService;
use Doctrine\DBAL\Exception\TableNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/shop/checkout', name: 'app_shop_checkout_')]
final class ShopCheckoutController extends AbstractController
{
    #[Route('', name: 'start', methods: ['POST'])]
    public function start(
        Request $request,
        PanierRepository $paniers,
        StripeCheckoutService $stripeCheckout,
        PromoCodeService $promoCodes,
        ShopCurrencyService $currencyService,
    ): RedirectResponse {
        $user = $this->getCurrentUser();
        $cartItems = $paniers->findCartItems($user);

        if ($cartItems === []) {
            $this->addFlash('warning', 'Your cart is empty.');

            return $this->redirectToRoute('app_cart');
        }

        try {
            $appliedPromo = null;

            try {
                $appliedPromo = $promoCodes->getAppliedPromo($request->getSession());
            } catch (TableNotFoundException|\Doctrine\DBAL\Exception $exception) {
                $this->addPromoMigrationWarning();
            }

            $pricing = $promoCodes->calculateSummary(
                $paniers->getCartTotal($user),
                $appliedPromo,
            );
            $currency = $currencyService->getCurrencyContext($request->getSession());
            $session = $stripeCheckout->createCheckoutSession(
                $cartItems,
                $this->generateUrl('app_shop_checkout_success', [], UrlGeneratorInterface::ABSOLUTE_URL).'?session_id={CHECKOUT_SESSION_ID}',
                $this->generateUrl('app_shop_checkout_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
                $currencyService->getStripeCurrency($currency['code']),
                $currency['rate'],
                $pricing,
            );
        } catch (\RuntimeException $exception) {
            $this->addFlash('warning', $exception->getMessage());

            return $this->redirectToRoute('app_cart');
        }

        return new RedirectResponse($session->url ?? $this->generateUrl('app_cart'));
    }

    #[Route('/success', name: 'success', methods: ['GET'])]
    public function success(
        Request $request,
        PanierRepository $paniers,
        EntityManagerInterface $entityManager,
        PromoCodeService $promoCodes,
    ): RedirectResponse {
        $user = $this->getCurrentUser();

        try {
            $promoCodes->markAppliedPromoUsed($request->getSession());
        } catch (TableNotFoundException|\Doctrine\DBAL\Exception $exception) {
            $this->addPromoMigrationWarning();
        }

        foreach ($paniers->findCartItems($user) as $item) {
            $entityManager->remove($item);
        }

        $entityManager->flush();

        $this->addFlash('success', 'Stripe checkout completed successfully.');

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cancel', name: 'cancel', methods: ['GET'])]
    public function cancel(): RedirectResponse
    {
        $this->addFlash('warning', 'Stripe checkout was cancelled.');

        return $this->redirectToRoute('app_cart');
    }

    private function getCurrentUser(): User
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('You need to sign in to access checkout.');
        }

        return $user;
    }

    private function addPromoMigrationWarning(): void
    {
        $this->addFlash(
            'warning',
            'Promo codes are unavailable until the shared shop promo migrations are applied. Run: php bin/console doctrine:migrations:execute \'DoctrineMigrations\\Version20260417110000\' --up --no-interaction then php bin/console doctrine:migrations:execute \'DoctrineMigrations\\Version20260417123000\' --up --no-interaction'
        );
    }
}


