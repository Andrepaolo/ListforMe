<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class FloatingCartButton extends Component
{
    public $itemCount = 0;

    // Escucha el evento 'productAddedToCart' disparado desde ProductList o RecipeList
    protected $listeners = ['productAddedToCart' => 'updateItemCount'];

    public function mount()
    {
        $this->updateItemCount(); // Cargar el conteo inicial al montar el componente
    }

    public function render()
    {
        return view('livewire.floating-cart-button');
    }

    public function updateItemCount()
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                // Suma la cantidad de todos los ítems en el carrito
                $this->itemCount = $cart->items->sum('quantity');
            } else {
                $this->itemCount = 0;
            }
        } else {
            $this->itemCount = 0;
        }
    }
}