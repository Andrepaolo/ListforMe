<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
           $table->id();
            $table->string('name');
            $table->text('description'); // Descripción general de la receta
            $table->longText('instructions'); // Pasos de preparación
            $table->string('image')->nullable(); // URL de la imagen de la receta
            $table->integer('estimated_calories')->nullable(); // Calorías estimadas
            $table->string('cuisine_type')->nullable(); // Ej: "Brasileña", "Mediterránea"
            $table->boolean('is_vegetarian')->default(false); // Para identificar versiones vegetarianas
            $table->timestamps();
        });

        // Tabla pivote para los productos de la receta (ej. recipe_product)
        Schema::create('recipe_product', function (Blueprint $table) {
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('quantity_unit'); // Ej: "2 tazas", "500g", "3 unidades"
            $table->timestamps();

            $table->primary(['recipe_id', 'product_id']); // Clave primaria compuesta
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
