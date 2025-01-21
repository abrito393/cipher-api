<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'currency_id',
        'tax_cost',
        'manufacturing_cost',
    ];

    /**
     * Relación con la tabla Currency.
     * Un producto pertenece a una moneda.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Relación con la tabla ProductPrices.
     * Un producto puede tener múltiples precios en diferentes monedas.
     */
    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }

}
