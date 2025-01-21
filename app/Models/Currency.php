<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'exchange_rate',
    ];

    /**
     * Relación con la tabla Products.
     * Una moneda puede estar asociada a muchos productos.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Relación con la tabla ProductPrices.
     * Una moneda puede estar asociada a muchos precios de productos.
     */
    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }
}
