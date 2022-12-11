<?php

declare(strict_types=1);

namespace App\Query;

use App\Models\Order;
use App\ValueObjects\OrderStatus;

final class FindOrdersQuery implements Query
{
    public function find(int $userId, OrderStatus $filter)
    {
        return Order::where('user_id', '=', $userId)->where('status', '=', $filter)->with('items')->get();
    }
}
