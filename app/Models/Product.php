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
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function storeProducts()
    {
        return $this->hasMany(StoreProduct::class);
    }
    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_products', 'product_id', 'store_id')
                    ->withPivot('stock', 'price')
                    ->withTimestamps();
    }
    public function preferences()
    {
        return $this->belongsToMany(Preference::class, 'product_preference'); // Usar tabla pivote product_preference
    }


}
