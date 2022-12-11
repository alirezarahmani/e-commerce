<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Commands\CreateOrderCommand;
use App\Models\Basket;
use App\Models\Order;
use App\Models\OrderItem;
use App\ValueObjects\OrderStatus;
use Assert\Assertion;

class CreateOrderHandler implements CommandHandler
{
    private float $wholePrice = 0.0;
    private float $tax = 0.0;

    public function handle(CreateOrderCommand $command): void
    {
        $products = $this->getProductsFromBaskets($command->userId());
        self::removePendingOrders($command->userId());
        $this->addOrders($products, $command->userId());
    }

    private function getProductsFromBaskets($userId)
    {
        $basketData = clone Basket::where('user_id', '=', $userId)->with('products')->first();
        Assertion::notEmpty($basketData, 'Sorry no basket found');
        $this->wholePrice = $basketData->value('price');
        return $basketData->Products;
    }

    private static function removePendingOrders(int $userId)
    {
        $pendingOrder = Order::where('user_id', '=', $userId)->where('status', '=', OrderStatus::PENDING)->first();
        if ($pendingOrder) {
            $pendingOrder->delete();
        }
    }

    private function addOrders($products, int $userId)
    {
        $id = Order::insertGetId([
            'user_id' => $userId,
            'whole_price' => $this->wholePrice + $this->tax,
            'tax' => $this->tax,
            'status' => OrderStatus::PENDING
        ]);
        $products->each(function ($product) use ($id) {
            OrderItem::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'order_id' => $id,
                ],
                [
                'quantity' => $product->pivot->quantity,
                'product_id' => $product->id,
                'brand' => $product->brand->name,
                'price' => $product->price,
                'order_id' => $id,
                'name' => $product->name
                ]
            );
        });
    }
}
