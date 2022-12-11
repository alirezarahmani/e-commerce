<?php

declare(strict_types=1);

namespace App\Commands;

final class DeleteProductCommand implements Command
{
    public function __construct(
        private readonly string $id,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }
}
