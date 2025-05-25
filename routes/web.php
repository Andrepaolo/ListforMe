<?php

use App\Livewire\Carrt;
use App\Livewire\ProductList;
use App\Livewire\RecipeList;
use App\Livewire\StoreManager;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::get('/product', ProductList::class)->name('product');
    Route::get('/cart', Carrt::class)->name('cart');
    Route::get('/recipes', RecipeList::class)->name('recipes');
    Route::get('/stores', StoreManager::class)->name('stores'); // Nueva ruta
    
});
