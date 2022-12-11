<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ProductAddedToBasket;

class OrderCreatedListener
{
    public function __construct()
    {
    }

    public function handle(ProductAddedToBasket $event)
    {
        // TODO: later
    }
}
