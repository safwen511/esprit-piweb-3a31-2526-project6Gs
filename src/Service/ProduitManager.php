<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Shopges\Produit;

class ProduitManager
{
    public function validate(Produit $produit): bool
    {
        if (trim($produit->getTitle()) === '') {
            throw new \InvalidArgumentException('Le titre du produit est obligatoire');
        }

        if ($produit->getPrice() <= 0) {
            throw new \InvalidArgumentException('Le prix doit etre superieur a zero');
        }

        if ($produit->getStock() < 0) {
            throw new \InvalidArgumentException('Le stock ne peut pas etre negatif');
        }

        return true;
    }
}
