<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ProductAddedToBasket;

class ProductRemovedFromBasketListener
{

    public function __construct()
    {
    }

    public function handle(ProductAddedToBasket $event)
    {
        // TODO: later
    }
}
