<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Basket;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductRemovedFromBasket
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public readonly Basket $basket)
    {
        //
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
