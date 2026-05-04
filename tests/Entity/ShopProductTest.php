<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Shopges\Produit;
use PHPUnit\Framework\TestCase;

final class ShopProductTest extends TestCase
{
    public function testUnknownCategoryFallsBackToMedical(): void
    {
        $product = (new Produit())->setCategory('unknown');

        self::assertSame('medical', $product->getCategory());
        self::assertSame('Medical', $product->getCategoryLabel());
    }

    public function testVisiblePriceRemovesTaxAmount(): void
    {
        $product = (new Produit())
            ->setPrice(120.0)
            ->setTva(20.0);

        self::assertSame(100.0, $product->getVisiblePrice());
    }
}
