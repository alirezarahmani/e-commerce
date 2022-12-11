<?php

declare(strict_types=1);

namespace App\Query;

use App\Models\Product;

final class FindProductsQuery implements Query
{
    public function find()
    {
        return Product::with('brand')->paginate();
    }
}
