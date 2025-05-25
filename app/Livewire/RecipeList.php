<?php

namespace App\Livewire;

use App\Models\Recipe;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\StoreProduct;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RecipeList extends Component
{
    use WithPagination;

    public $selectedRecipeId = null;
    public $showRecipeModal = false;
    public $selectedRecipe = null;

    public $selectedStorePerIngredient = [];
    public $quantitiesPerIngredient = [];
    public $availableStoresForRecipe = [];
    public $cartSummaryMessage = '';

    public $searchIngredients = ''; 

    protected $listeners = ['productAddedToCart' => 'updateCartSummary'];

    public function render()
    {
        $query = Recipe::query()->with(['ingredients.stores']);

        if (!empty($this->searchIngredients)) {
            $searchTerms = array_map('trim', explode("\n", $this->searchIngredients));
            $searchTerms = array_filter($searchTerms); 

            if (!empty($searchTerms)) {
                // *** ¡NUEVA LÓGICA DE FILTRADO CON JOIN EXPLÍCITO! ***
                $query->whereHas('ingredients', function ($q) use ($searchTerms) {
                    // Aquí, en lugar de confiar solo en el contexto de whereHas,
                    // unimos explícitamente la tabla 'products' (a la que la relación 'ingredients' apunta)
                    // para asegurar que la columna 'name' sea accesible.
                    $q->where(function ($subQuery) use ($searchTerms) {
                        foreach ($searchTerms as $term) {
                            $subQuery->orWhere('products.name', 'like', '%' . $term . '%');
                        }
                    });
                });
            }
        }

        $recipes = $query->paginate(6); 
        
        return view('livewire.recipe-list', compact('recipes'))
            ->layout('layouts.app');
    }

    public function updatedSearchIngredients()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->searchIngredients = ''; 
        $this->resetPage(); 
    }

    public function showRecipe($recipeId)
    {
        $this->selectedRecipeId = $recipeId;
        $this->showRecipeModal = true;
        $this->selectedStorePerIngredient = [];
        $this->quantitiesPerIngredient = [];

        $this->selectedRecipe = Recipe::with('ingredients.stores')->find($recipeId);

        if ($this->selectedRecipe) {
            $commonStores = [];
            foreach ($this->selectedRecipe->ingredients as $ingredientProduct) {
                $productStores = $ingredientProduct->stores->pluck('id')->toArray();
                if (!empty($productStores)) {
                    if (empty($commonStores)) {
                        $commonStores = $productStores;
                    } else {
                        $commonStores = array_intersect($commonStores, $productStores);
                    }
                } else {
                    $commonStores = [];
                    break;
                }
            }
            $this->availableStoresForRecipe = $commonStores;

            foreach ($this->selectedRecipe->ingredients as $ingredientProduct) {
                $defaultQuantity = (float) filter_var($ingredientProduct->pivot->quantity_unit, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $this->quantitiesPerIngredient[$ingredientProduct->id] = max(1, $defaultQuantity);
            }
        }
    }

    public function closeRecipeModal()
    {
        $this->showRecipeModal = false;
        $this->selectedRecipeId = null;
        $this->selectedRecipe = null;
    }


    public function addToCartAllIngredients()
    {
        if (!Auth::check()) {
            $this->dispatch('alert', type: 'error', title: 'Você precisa fazer login para adicionar produtos ao carrinho.');
            return;
        }

        $recipe = $this->selectedRecipe;

        if (!$recipe) {
            $this->dispatch('alert', type: 'error', title: 'Receita não encontrada.');
            return;
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $totalItemsAdded = 0;
        $failedItems = [];

        foreach ($recipe->ingredients as $ingredientProduct) {
            $productId = $ingredientProduct->id;
            $quantity = max(1, (float) ($this->quantitiesPerIngredient[$productId] ?? filter_var($ingredientProduct->pivot->quantity_unit, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)));
            $selectedStoreId = $this->selectedStorePerIngredient[$productId] ?? null;

            if (empty($selectedStoreId)) {
                $failedItems[] = $ingredientProduct->name . ' (sem loja selecionada)';
                continue;
            }

            $storeProduct = StoreProduct::where('product_id', $productId)
                                        ->where('store_id', $selectedStoreId)
                                        ->first();

            if (!$storeProduct) {
                $failedItems[] = $ingredientProduct->name . ' (não encontrado na loja selecionada)';
                continue;
            }

            if ($storeProduct->stock < $quantity) {
                $failedItems[] = $ingredientProduct->name . ' (estoque insuficiente na loja ' . $storeProduct->store->name . ')';
                continue;
            }

            $cartItem = CartItem::firstOrNew([
                'cart_id' => $cart->id,
                'store_product_id' => $storeProduct->id,
            ]);

            $cartItem->quantity += $quantity;
            $cartItem->save();

            $storeProduct->stock -= $quantity;
            $storeProduct->save();

            $totalItemsAdded++;
        }

        if ($totalItemsAdded > 0) {
            $message = "Foram adicionados {$totalItemsAdded} itens da receita ao seu carrinho.";
            if (!empty($failedItems)) {
                $message .= " Problemas com: " . implode(', ', $failedItems) . ".";
            }
            $this->dispatch('alert', type: 'success', title: $message);
            $this->dispatch('productAddedToCart');
        } else {
            $this->dispatch('alert', type: 'error', title: 'Nenhum item da receita pôde ser adicionado ao carrinho. ' . implode(', ', $failedItems));
        }

        $this->closeRecipeModal();
    }
}