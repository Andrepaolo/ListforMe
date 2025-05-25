<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Preference;
use App\Models\Category;
use App\Models\StoreProduct;
use Illuminate\Support\Facades\Auth;

class ProductList extends Component
{
    use WithPagination;

    public $selectedPreferences = [];
    public $selectedCategory = '';
    public $showModal = false;
    public $selectedProductId;
    public $search = ''; // Esta propiedad ahora contendrá el texto multilínea del textarea
    public $applyFilter = false;
    public $productList = [];
    public $selectedStorePerProduct = [];
    public $selectedStoreInModal = null;
    public $modalQuantity = 1;
    public $canAddToCart = false;
    
    public $quantities = []; 

    public $categoryIcons = [
        'Bebidas' => 'fas fa-wine-bottle', 
        'Laticínios' => 'fas fa-cheese', 
        'Padaria' => 'fas fa-bread-slice', 
        'Frutas' => 'fas fa-apple-alt', 
        'Vegetais' => 'fas fa-carrot', 
        'Carnes e Aves' => 'fas fa-drumstick-bite', 
        'Grãos e Cereais' => 'fas fa-seedling', 
        'Temperos e Condimentos' => 'fas fa-pepper-hot', 
        'Outros' => 'fas fa-boxes', 
    ];

    public function mount()
    {
        $this->productList = Product::with('category')->orderBy('id', 'desc')->get()->toArray();
    }

    public function render()
    {
        $query = Product::with(['category', 'stores', 'preferences']);

        if (!empty($this->selectedCategory)) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->applyFilter && !empty($this->selectedPreferences)) {
            $query->whereHas('preferences', function ($q) {
                $q->whereIn('preferences.id', $this->selectedPreferences);
            });
        }

        // ¡NUEVO! Lógica para el filtro de lista de compras (textarea)
        if (!empty($this->search)) {
            // Dividir el texto del textarea por saltos de línea
            $searchTerms = array_map('trim', explode("\n", $this->search));
            // Eliminar términos vacíos
            $searchTerms = array_filter($searchTerms); 

            if (!empty($searchTerms)) {
                $query->where(function ($q) use ($searchTerms) {
                    foreach ($searchTerms as $term) {
                        // Buscar productos cuyos nombres contengan cualquiera de los términos
                        $q->orWhere('name', 'like', '%' . $term . '%');
                    }
                });
            }
        }

        $products = $query->orderBy('id', 'desc')->paginate(18);
        $preferences = Preference::all();
        $categories = Category::all();

        foreach ($products as $product) {
            if (!isset($this->quantities[$product->id])) {
                $this->quantities[$product->id] = 1;
            }
            if (!isset($this->selectedStorePerProduct[$product->id])) {
                $this->selectedStorePerProduct[$product->id] = ''; 
            }
        }

        return view('livewire.product-list', compact('products', 'preferences', 'categories'))
            ->layout('layouts.app');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function showProduct($id)
    {
        $this->selectedProductId = $id;
        $this->selectedStoreInModal = null; 
        $this->modalQuantity = 1;
        $this->showModal = true;
    }

    public function applyFilters()
    {
        $this->applyFilter = true;
        $this->resetPage();
    }

    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage();
        $this->applyFilters(); 
    }

    public function previousProduct()
    {
        $index = collect($this->productList)->search(fn($product) => $product['id'] == $this->selectedProductId);
        if ($index > 0) {
            $this->selectedProductId = $this->productList[$index - 1]['id'];
            $this->selectedStoreInModal = null; 
            $this->modalQuantity = 1; 
        }
    }

    public function nextProduct()
    {
        $index = collect($this->productList)->search(fn($product) => $product['id'] == $this->selectedProductId);
        if ($index < count($this->productList) - 1) {
            $this->selectedProductId = $this->productList[$index + 1]['id'];
            $this->selectedStoreInModal = null; 
            $this->modalQuantity = 1; 
        }
    }

    public function addToCart($productId, $storeId, $quantity = 1)
    {
        $quantity = max(1, (int) $quantity);

        if (!$storeId || $quantity < 1) {
            $this->dispatch('alert', type: 'error', title: 'Selecione uma loja e uma quantidade válida.');
            return;
        }

        if (!Auth::check()) {
            $this->dispatch('alert', type: 'error', title: 'Você precisa fazer login para adicionar produtos ao carrinho.');
            return;
        }

        $storeProduct = StoreProduct::where('product_id', $productId)->where('store_id', $storeId)->first();

        if (!$storeProduct) {
            $this->dispatch('alert', type: 'error', title: 'Produto não disponível na loja selecionada.');
            return;
        }

        if ($storeProduct->stock < $quantity) {
            $this->dispatch('alert', type: 'error', title: 'Não há estoque suficiente deste produto na loja.');
            return;
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $cartItem = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'store_product_id' => $storeProduct->id,
        ]);

        $cartItem->quantity += $quantity;
        $cartItem->save();

        $this->dispatch('alert', type: 'success', title: 'Produto adicionado ao carrinho com sucesso!');
        $this->dispatch('productAddedToCart');
        $this->showModal = false; 
        $this->modalQuantity = 1; 
        $this->selectedStoreInModal = null; 
    }

    public function addToCartFromModal() 
    {
        $this->addToCart($this->selectedProductId, $this->selectedStoreInModal, $this->modalQuantity);
    }

    public function clearFilters()
    {
        $this->selectedCategory = null; 
        $this->selectedPreferences = []; 
        $this->search = ''; // Limpia el textarea de búsqueda
        $this->applyFilter = false; 
        $this->resetPage(); 
    }
}