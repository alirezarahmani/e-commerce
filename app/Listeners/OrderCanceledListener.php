<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\OrderCanceled;
use App\Models\Basket;
use Illuminate\Support\Facades\Auth;

class OrderCanceledListener
{
    public function __construct()
    {
        //
    }

    public function handle(OrderCanceled $event)
    {
        // remove basket after order is canceled
        Basket::where('user_id', Auth::id())->delete();
    }
}
