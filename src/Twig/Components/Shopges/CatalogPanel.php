<?php

declare(strict_types=1);

namespace App\Twig\Components\Shopges;

use App\Entity\Shopges\Produit;
use App\Entity\User;
use App\Repository\Shopges\PanierRepository;
use App\Repository\Shopges\ProduitRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('codex_shop_catalog_panel')]
final class CatalogPanel
{
    use DefaultActionTrait;

    #[LiveProp(writable: true, url: true)]
    public string $q = '';

    #[LiveProp(writable: true, url: true)]
    public string $category = 'all';

    #[LiveProp(writable: true, url: true)]
    public string $minPrice = '';

    #[LiveProp(writable: true, url: true)]
    public string $maxPrice = '';

    #[LiveProp(writable: true, url: true)]
    public int $page = 1;

    /**
     * @var PaginationInterface<int, Produit>|null
     */
    private ?PaginationInterface $pagination = null;

    /**
     * @var array<int, int>|null
     */
    private ?array $cartQuantities = null;

    public function __construct(
        private readonly ProduitRepository $produits,
        private readonly PanierRepository $paniers,
        private readonly PaginatorInterface $paginator,
        private readonly Security $security,
    ) {
    }

    /**
     * @return array<string, string>
     */
    public function getCategories(): array
    {
        return $this->produits->getAvailableCategories();
    }

    /**
     * @return PaginationInterface<int, Produit>
     */
    public function getPagination(): PaginationInterface
    {
        if ($this->pagination instanceof PaginationInterface) {
            return $this->pagination;
        }

        $pagination = $this->paginator->paginate(
            $this->produits->createShopSearchQueryBuilder($this->getFilters()),
            max(1, $this->page),
            8,
        );
        $this->pagination = $pagination;

        $items = $pagination->getItems();
        $itemCount = is_countable($items) ? count($items) : iterator_count((static function () use ($items): \Traversable {
            yield from $items;
        })());

        if ((int) $pagination->getCurrentPageNumber() > 1 && $itemCount === 0) {
            $this->page = 1;
            $this->pagination = $this->paginator->paginate(
                $this->produits->createShopSearchQueryBuilder($this->getFilters()),
                1,
                8,
            );
        }

        return $this->pagination;
    }

    /**
     * @return array<int, int>
     */
    public function getCartQuantities(): array
    {
        if ($this->cartQuantities !== null) {
            return $this->cartQuantities;
        }

        $user = $this->getCurrentUser();

        $this->cartQuantities = $user instanceof User ? $this->paniers->getQuantitiesByProductId($user) : [];

        return $this->cartQuantities;
    }

    /**
     * @return array<int, int>
     */
    public function getPageWindow(): array
    {
        $pagination = $this->getPagination();
        $current = max(1, (int) $pagination->getCurrentPageNumber());
        $currentItemCount = count($pagination);
        $perPage = $currentItemCount > 0 ? $currentItemCount : 8;
        $totalItems = $pagination->getTotalItemCount();
        $pageCount = max(1, (int) ceil($totalItems / $perPage));
        $start = max(1, $current - 2);
        $end = min($pageCount, $start + 4);
        $start = max(1, $end - 4);

        return range($start, $end);
    }

    #[LiveAction]
    public function setCategory(#[LiveArg] string $category): void
    {
        $this->category = array_key_exists($category, $this->getCategories()) ? $category : 'all';
        $this->resetPagination();
    }

    #[LiveAction]
    public function setPage(#[LiveArg] int $page): void
    {
        $this->page = max(1, $page);
        $this->pagination = null;
    }

    #[LiveAction]
    public function resetFilters(): void
    {
        $this->q = '';
        $this->category = 'all';
        $this->minPrice = '';
        $this->maxPrice = '';
        $this->resetPagination();
    }

    public function onUpdatedQ(): void
    {
        $this->resetPagination();
    }

    public function onUpdatedMinPrice(): void
    {
        $this->resetPagination();
    }

    public function onUpdatedMaxPrice(): void
    {
        $this->resetPagination();
    }

    public function onUpdatedCategory(): void
    {
        $this->resetPagination();
    }

    /**
     * @return array{q: string, category: string, min_price: string, max_price: string}
     */
    private function getFilters(): array
    {
        return [
            'q' => trim($this->q),
            'category' => trim($this->category) !== '' ? trim($this->category) : 'all',
            'min_price' => trim($this->minPrice),
            'max_price' => trim($this->maxPrice),
        ];
    }

    private function getCurrentUser(): ?User
    {
        $user = $this->security->getUser();

        return $user instanceof User ? $user : null;
    }

    private function resetPagination(): void
    {
        $this->page = 1;
        $this->pagination = null;
        $this->cartQuantities = null;
    }
}
