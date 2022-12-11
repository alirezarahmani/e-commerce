<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Commands\RemoveProductCommand;
use App\Models\Product;

class RemoveProductHandler implements CommandHandler
{
    public function handle(RemoveProductCommand $command): void
    {
        Product::destroy($command->id());
    }
}
