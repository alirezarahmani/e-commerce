<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Commands\FinalizeOrderCommand;
use App\Events\OrderDone;
use App\Models\Order;
use App\ValueObjects\OrderStatus;

class FinalizeOrderHandler implements CommandHandler
{
    public function handle(FinalizeOrderCommand $command): void
    {
        $order = Order::where('user_id', '=', 1)->where('id', '=', $command->id())->first();
        $order->status = OrderStatus::DONE;
        $order->save();
        OrderDone::dispatch($order);
    }
}
