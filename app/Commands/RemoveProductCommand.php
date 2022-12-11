<?php

declare(strict_types=1);

namespace App\Commands;

final class RemoveProductCommand implements Command
{
    public function __construct(private readonly int $id)
    {
    }

    public function id(): int
    {
        return $this->id;
    }
}
