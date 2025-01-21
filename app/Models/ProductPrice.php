<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'currency_id',
        'price',
    ];

    /**
     * Relación con la tabla Product.
     * Un precio pertenece a un producto.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relación con la tabla Currency.
     * Un precio está asociado a una moneda específica.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
