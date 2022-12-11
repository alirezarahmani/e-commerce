<?php

declare(strict_types=1);

namespace App\Commands;

final class FinalizeOrderCommand implements Command
{
    public function __construct(
        private readonly int $user_id,
        private readonly int $id,
    ) {
    }

    public function userId(): int
    {
        return $this->user_id;
    }

    public function id(): int
    {
        return $this->id;
    }
}
