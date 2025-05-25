<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\StoreProduct; // Asegúrate de que esta importación exista
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Carrt extends Component
{
    public $cartItems = [];
    public $totalPrice = 0;
    public $healthySuggestions = [];
    public $unhealthyProductsInCart = []; // Nueva propiedad para productos no saludables en el carrito
    public $selectedStorePerProduct = []; // Esto es crucial para las sugerencias

    protected $listeners = ['productAddedToCart' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        if (Auth::check()) {
            $cart = Cart::with(['items.storeProduct.product', 'items.storeProduct.store'])->firstWhere('user_id', Auth::id());

            if ($cart) {
                $this->cartItems = $cart->items;
                $this->calculateTotalPrice();
            } else {
                $this->cartItems = [];
                $this->totalPrice = 0;
            }
        } else {
            $this->cartItems = [];
            $this->totalPrice = 0;
        }

        $this->loadHealthySuggestions();
        $this->identifyUnhealthyProductsInCart(); // Cargar productos no saludables
    }

    public function calculateTotalPrice()
    {
        $this->totalPrice = 0;
        foreach ($this->cartItems as $item) {
            $this->totalPrice += $item->quantity * $item->storeProduct->price;
        }
    }

    public function updateQuantity($cartItemId, $quantity)
    {
        $quantity = max(1, (int) $quantity);

        $cartItem = CartItem::find($cartItemId);

        if ($cartItem) {
            $storeProduct = $cartItem->storeProduct;

            if ($storeProduct->stock < $quantity) {
                $this->dispatch('alert', type: 'error', title: 'No hay suficiente stock disponible para esta cantidad.');
                $this->loadCart();
                return;
            }

            $cartItem->quantity = $quantity;
            $cartItem->save();
            $this->dispatch('alert', type: 'success', title: 'Cantidad actualizada.');
        }

        $this->loadCart();
    }

    public function removeItem($cartItemId)
    {
        CartItem::destroy($cartItemId);
        $this->dispatch('alert', type: 'success', title: 'Producto eliminado del carrito.');
        $this->loadCart();
    }

    public function loadHealthySuggestions()
    {
        $productIdsInCart = collect($this->cartItems)->map(function ($item) {
            return $item->storeProduct->product_id;
        })->toArray();

        $this->healthySuggestions = Product::where('is_healthy', true)
            ->whereNotIn('id', $productIdsInCart)
            ->whereHas('stores')
            ->with('stores')
            ->limit(3)
            ->get();

        // Inicializar selectedStorePerProduct para cada sugerencia si no está ya
        foreach ($this->healthySuggestions as $suggestion) {
            if (!isset($this->selectedStorePerProduct[$suggestion->id])) {
                $this->selectedStorePerProduct[$suggestion->id] = ''; // Inicializar a vacío
            }
        }
    }

    // Nuevo método para identificar productos no saludables en el carrito
    public function identifyUnhealthyProductsInCart()
    {
        $this->unhealthyProductsInCart = collect($this->cartItems)
            ->filter(function ($item) {
                // Si el producto NO es saludable
                return !$item->storeProduct->product->is_healthy;
            })
            ->map(function ($item) {
                return [
                    'name' => $item->storeProduct->product->name,
                    'image' => $item->storeProduct->product->image,
                    'quantity' => $item->quantity,
                ];
            })
            ->values() // Reindexar el array
            ->toArray(); // Si prefieres pasarlo como array a la vista
    }


    public function addSuggestedProductToCart($productId, $storeId)
    {
        $quantity = 1; // Por defecto, añade 1 unidad de la sugerencia

        if (!Auth::check()) {
            $this->dispatch('alert', type: 'error', title: 'Debes iniciar sesión para añadir productos.');
            return;
        }

        // Si $storeId llega como 'null' (cadena) de la vista, lo convertimos a null real
        if ($storeId === 'null' || empty($storeId)) {
            $this->dispatch('alert', type: 'error', title: 'Selecciona una tienda para la sugerencia.');
            return;
        }

        $storeProduct = StoreProduct::where('product_id', $productId)
                                    ->where('store_id', $storeId)
                                    ->first();

        if (!$storeProduct) {
            $this->dispatch('alert', type: 'error', title: 'Producto sugerido no disponible en la tienda seleccionada.');
            return;
        }

        if ($storeProduct->stock < $quantity) {
            $this->dispatch('alert', type: 'error', title: 'No hay suficiente stock de este producto sugerido.');
            return;
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $cartItem = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'store_product_id' => $storeProduct->id,
        ]);

        $cartItem->quantity += $quantity;
        $cartItem->save();

        $this->dispatch('alert', type: 'success', title: 'Sugerencia añadida al carrito.');
        $this->loadCart();
    }

    public function render()
    {
        return view('livewire.carrt')->layout('layouts.app');
    }
}