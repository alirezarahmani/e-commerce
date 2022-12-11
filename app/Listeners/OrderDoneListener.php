<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\OrderDone;
use App\Models\Basket;
use Illuminate\Support\Facades\Auth;

class OrderDoneListener
{
    public function __construct()
    {
    }

    public function handle(OrderDone $event)
    {
        // truncate basket after order is done
        Basket::where('user_id', Auth::id())->delete();
    }
}
