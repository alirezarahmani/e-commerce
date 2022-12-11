<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ProductAddedToBasket;

class ProductAddedToBasketListener
{
    public function __construct()
    {
        //
    }

    public function handle(ProductAddedToBasket $event)
    {
        // TODO: later
    }
}
