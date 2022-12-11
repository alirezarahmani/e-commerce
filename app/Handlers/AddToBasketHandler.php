<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Commands\AddToBasketCommand;
use App\Events\ProductAddedToBasket;
use App\Models\Basket;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AddToBasketHandler implements CommandHandler
{
    public function handle(AddToBasketCommand $command): void
    {
        // Get basket
        try {
            $basket = Basket::where('user_id', $command->userId())->firstOrFail();
            $id = $basket->getKey();
        } catch (ModelNotFoundException $e) {
            $id = Basket::insertGetId([
                'user_id' => $command->userId(),
                'price' => 0.0,
            ]);
            $basket = Basket::find($id);
        }

        // Update pivot
        $pivot = clone $basket->products()->select('price', 'quantity')
            ->where('product_id', '=', $command->product()->id);
        if (!$pivot->count()) {
            $basket->products()->attach($command->product()->id, ['basket_id' => $id, 'quantity' => 1]);
        } else {
            $quantity = $pivot->value('quantity');
            $basket->products()->updateExistingPivot($command->product()->id, ['quantity' => ++$quantity]);
        }

        // update whole price of basket
        $basket->price += $pivot->value('price');
        $basket->save();

        // raise event
        ProductAddedToBasket::dispatch($basket);
    }
}
