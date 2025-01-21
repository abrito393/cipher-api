<?php

namespace App\Presenters;

use App\Models\Product;

class ProductPresenter
{
    public static function format(Product $product): array
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'currency' => [
                'id' => $product->currency->id,
                'name' => $product->currency->name,
                'symbol' => $product->currency->symbol,
            ],
            'tax_cost' => $product->tax_cost,
            'manufacturing_cost' => $product->manufacturing_cost,
        ];
    }
}