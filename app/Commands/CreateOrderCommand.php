<?php

declare(strict_types=1);

namespace App\Commands;

final class CreateOrderCommand implements Command
{
    public function __construct(
        private readonly int $user_id,
    ) {
    }

    public function userId(): int
    {
        return $this->user_id;
    }
}
