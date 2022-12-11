<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Commands\DeleteProductCommand;
use App\Models\Product;

class DeleteProductHandler implements CommandHandler
{
    public function handle(DeleteProductCommand $command): void
    {
        Product::destroy($command->id());
    }
}
