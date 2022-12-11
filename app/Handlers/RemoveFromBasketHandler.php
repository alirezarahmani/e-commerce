<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Commands\RemoveFromBasketCommand;
use App\Events\ProductRemovedFromBasket;
use App\Models\Basket;

class RemoveFromBasketHandler implements CommandHandler
{
    public function handle(RemoveFromBasketCommand $command): void
    {
        // Get basket
        $price = 0;
        $basket = Basket::where('user_id', $command->userId())->firstOrFail();
        $pivot =  clone $basket->products()->select('price', 'quantity')
            ->where('product_id', '=', $command->product()->id);
        if ($pivot->value('quantity') > 1) {
            $price = abs($basket->value('price') - $pivot->value('price'));
            $quantity = $pivot->value('quantity');
            $basket->products()->updateExistingPivot($command->product()->id, ['quantity' => abs(--$quantity)]);
        } else {
            $basket->products()->detach($command->product()->id);
        }
        $basket->price = $price;
        $basket->save();
        //fire event
        ProductRemovedFromBasket::dispatch($basket);
    }
}
