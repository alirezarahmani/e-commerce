<?php

declare(strict_types=1);

namespace App\Query;

use App\Models\Product;

final class FindSingleProductQuery implements Query
{
    public function find($id)
    {
        return Product::findorfail($id)->with('brand')->first();
    }
}
