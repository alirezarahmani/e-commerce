<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Commands\CancelOrderCommand;
use App\Models\Order;
use App\ValueObjects\OrderStatus;

class CancelOrderHandler implements CommandHandler
{
    public function handle(CancelOrderCommand $command): void
    {
           $order = Order::where('user_id', '=', $command->userId())->where('id', '=', $command->id())->first();
           $order->status = OrderStatus::CANCELED;
           $order->save();
    }
}
