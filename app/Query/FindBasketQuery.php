<?php

declare(strict_types=1);

namespace App\Query;

use App\Models\Basket;

final class FindBasketQuery implements Query
{
    public function find($userId)
    {
        // TODO: improve query result as we are in query side
        return Basket::where('user_id', '=', $userId)->with('products')->first();
    }
}
