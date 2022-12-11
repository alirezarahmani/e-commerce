<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\Brand;
use App\Models\Product;
use App\ValueObjects\ProductName;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row): Product
    {
        $currency = new Currency('EUR');
        $rowPrice = intval(filter_var($row['price'], FILTER_SANITIZE_NUMBER_INT));
        $price = new Money($rowPrice, $currency);
        $brand = Brand::firstOrCreate(['name' => $row['brand']]);

        $productName = new ProductName($row['product_name']);

        return new Product([
            'name' => $productName->value(),
            'brand_id' => $brand->id,
            'price' => $price->getAmount(),
        ]);
    }
}
