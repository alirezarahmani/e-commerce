<?php

declare(strict_types=1);

namespace App\Commands;
final class ImportProductCommand implements Command
{
    public function __construct(
        private readonly string $file,
    ) {
    }

    public function file(): string
    {
        return $this->file;
    }
}
