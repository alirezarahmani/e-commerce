<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Commands\CreateProductCommand;
use App\Models\Product;

class CreateProductHandler implements CommandHandler
{
    public function handle(CreateProductCommand $command): void
    {
        Product::create([
            'name' => $command->name(),
            'price' => $command->price()->getAmount(),
            'stock' => $command->stock(),
            'brand_id' => $command->brand()->id
        ]);
    }
}
