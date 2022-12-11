<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Commands\ImportProductCommand;
use App\Imports\ProductImport;
use Assert\Assertion;
use Maatwebsite\Excel\Facades\Excel;

class ImportProductHandler implements CommandHandler
{
    public function handle(ImportProductCommand $command): void
    {
        Excel::import(new ProductImport(), $command->file());
    }
}
