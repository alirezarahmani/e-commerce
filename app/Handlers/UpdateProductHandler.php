<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Commands\UpdateProductCommand;
use App\Models\Product;

class UpdateProductHandler implements CommandHandler
{
    public function handle(UpdateProductCommand $command): void
    {
        Product::where('id', $command->id())->update([
            'name' => $command->name(),
            'price' => $command->price()->getAmount(),
            'stock' => $command->stock(),
            'brand_id' => $command->brand()->id
        ]);
    }
}
