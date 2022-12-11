<?php

declare(strict_types=1);

namespace App\Commands;

use App\Models\Product;

final class AddToBasketCommand implements Command
{
    public function __construct(
        private readonly int $product_id,
        private readonly int $user_id,
    ) {
    }

    public function product(): Product
    {
        return Product::findOrfail($this->product_id);
    }

    public function userId(): int
    {
        return $this->user_id;
    }
}
