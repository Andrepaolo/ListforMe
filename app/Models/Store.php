<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'latitud',
        'longitude',
    ];

    public function storeProducts()
    {
        return $this->hasMany(StoreProduct::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'store_products', 'store_id', 'product_id')
                    ->withPivot('stock', 'price') // si tienes más columnas en la tabla intermedia
                    ->withTimestamps();
    }
}
