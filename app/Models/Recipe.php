<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'instructions',
        'image',
        'estimated_calories',
        'cuisine_type',
        'is_vegetarian',
    ];
    public function ingredients()
    {
        return $this->belongsToMany(Product::class, 'recipe_product')
                    ->withPivot('quantity_unit') // Para acceder a la cantidad y unidad
                    ->withTimestamps();
    }
    public function getInstructionStepsAttribute()
     {
         return explode("\n", $this->instructions); // Divide las instrucciones por salto de línea
    }
}
