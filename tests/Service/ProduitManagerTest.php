<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Shopges\Produit;
use App\Service\ProduitManager;
use PHPUnit\Framework\TestCase;

class ProduitManagerTest extends TestCase
{
    public function testValidProduit(): void
    {
        $produit = (new Produit())
            ->setTitle('Croquettes premium')
            ->setPrice(49.99)
            ->setStock(12);

        $manager = new ProduitManager();

        self::assertTrue($manager->validate($produit));
    }

    public function testProduitWithoutTitle(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le titre du produit est obligatoire');

        $produit = (new Produit())
            ->setTitle('   ')
            ->setPrice(49.99)
            ->setStock(12);

        $manager = new ProduitManager();
        $manager->validate($produit);
    }

    public function testProduitWithInvalidPrice(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le prix doit etre superieur a zero');

        $produit = (new Produit())
            ->setTitle('Croquettes premium')
            ->setPrice(0)
            ->setStock(12);

        $manager = new ProduitManager();
        $manager->validate($produit);
    }

    public function testProduitWithNegativeStock(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le stock ne peut pas etre negatif');

        $produit = (new Produit())
            ->setTitle('Croquettes premium')
            ->setPrice(49.99)
            ->setStock(-2);

        $manager = new ProduitManager();
        $manager->validate($produit);
    }
}
