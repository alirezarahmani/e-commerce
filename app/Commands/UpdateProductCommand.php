<?php

declare(strict_types=1);

namespace App\Commands;

use App\Models\Brand;
use App\ValueObjects\ProductName;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

final class UpdateProductCommand implements Command
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly int $price,
        private readonly int $stock,
        private readonly int $brand_id,
    ) {
    }

    public function name(): ProductName
    {
        return new ProductName($this->name);
    }

    public function price(): Money
    {
        $currency = new Currency('EUR');
        return new Money($this->price, $currency);
    }

    public function stock(): float
    {
        return $this->stock;
    }

    public function brand(): Brand
    {
        $brand = Brand::findorFail($this->brand_id);
        return $brand;
    }

    public function id(): int
    {
        return $this->id;
    }
}
