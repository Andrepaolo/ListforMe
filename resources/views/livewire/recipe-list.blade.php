<div class="p-6 space-y-8 bg-[#f5f0e6] min-h-screen">
    <h1 class="text-4xl font-extrabold text-[#556b2f] text-center mb-8">Nossas Receitas</h1>

    <div class="flex flex-col md:flex-row gap-8 mt-6">

        {{-- Filtro de Ingredientes (Sidebar Izquierda) --}}
        <aside class="w-full md:w-1/4 bg-[#e8e4d8] p-5 rounded-xl shadow border border-[#c8c5b7] h-fit sticky top-6">
            <h3 class="font-semibold text-[#6b705c] mb-4 text-lg">Filtrar por Ingredientes</h3>
            
            {{-- Campo de Búsqueda por Lista (Textarea) --}}
            <div class="mb-6">
                <label for="search-ingredients" class="font-semibold text-[#6b705c] mb-2 block text-sm">Sua Lista de Ingredientes</label>
                <textarea 
                    id="search-ingredients" 
                    wire:model.live.debounce.500ms="searchIngredients" 
                    placeholder="Digite os ingredientes, um por linha:&#10;Batatas&#10;Leite&#10;Cebola"
                    rows="6" 
                    class="w-full border border-[#a7b48c] rounded-md p-3 text-[#556b2f] placeholder-[#7a7a58] focus:ring-[#8f9779] focus:border-[#8f9779] resize-y"
                ></textarea>
                <p class="text-xs text-[#7a7a58] mt-1">Cada ingrediente em uma nova linha.</p>
            </div>

            <button wire:click="clearFilters"
                class="mt-3 bg-red-500 hover:bg-red-600 text-white font-semibold w-full py-3 rounded-lg transition-colors duration-300 shadow">
                Limpar Filtros
            </button>
        </aside>

        {{-- Lista de Receitas --}}
        <section class="w-full md:w-3/4">
            @if($recipes->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6"> {{-- Ajustado a 3 columnas para ser más pequeño --}}
                    @foreach($recipes as $recipe)
                        <div class="bg-white rounded-xl shadow-lg border border-[#d3d0c8] flex flex-col p-4"> {{-- Padding ligeramente reducido --}}
                            @if($recipe->image)
                                @if(Str::startsWith($recipe->image, ['http://', 'https://']))
                                    <img src="{{ $recipe->image }}" alt="{{ $recipe->name }}" class="rounded-lg object-cover h-40 mb-3 w-full"> {{-- Altura reducida --}}
                                @else
                                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}" class="rounded-lg object-cover h-40 mb-3 w-full">
                                @endif
                            @else
                                <div class="h-40 bg-[#d9d7cc] mb-3 rounded-lg flex items-center justify-center text-[#7a7a58]">Sem Imagem</div>
                            @endif

                            <h3 class="font-bold text-lg text-[#556b2f] mb-1">{{ $recipe->name }}</h3> {{-- Tamaño de texto ligeramente reducido --}}
                            <p class="text-xs text-[#7a7a58] mb-3 flex-grow">{{ Str::limit($recipe->description, 70) }}</p> {{-- Límite de descripción reducido --}}

                            <div class="mt-auto pt-3 border-t border-[#f0f0e6]"> {{-- Padding y borde ligeramente reducidos --}}
                                <button wire:click="showRecipe({{ $recipe->id }})"
                                    class="w-full bg-[#556b2f] hover:bg-[#425823] text-white font-semibold py-2 rounded-lg text-sm transition-colors duration-300 shadow"> {{-- Tamaño de botón y texto reducido --}}
                                    Ver Receita
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $recipes->links('vendor.livewire.tailwind') }}
                </div>
            @else
                <p class="text-center text-[#7a7a58] text-lg py-10">Nenhuma receita encontrada com os ingredientes selecionados.</p>
            @endif
        </section>
    </div>

    {{-- Modal da Receita --}}
    @if($showRecipeModal && $selectedRecipe)
        <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 p-4">
            <div class="bg-[#fdf6e3] rounded-2xl w-full max-w-4xl shadow-xl overflow-y-auto max-h-[90vh]">

                <div class="flex justify-between items-center p-6 border-b border-[#e2dfd3]">
                    <h2 class="text-3xl font-extrabold text-[#556b2f]">{{ $selectedRecipe->name }}</h2>
                    <button wire:click="closeRecipeModal" class="text-gray-500 hover:text-gray-700 text-2xl font-bold">
                        &times;
                    </button>
                </div>

                <div class="p-6">
                    @if($selectedRecipe->image)
                        @if(Str::startsWith($selectedRecipe->image, ['http://', 'https://']))
                            <img src="{{ $selectedRecipe->image }}" alt="{{ $selectedRecipe->name }}" class="rounded-lg object-cover h-64 w-full mb-6">
                        @else
                            <img src="{{ asset('storage/' . $selectedRecipe->image) }}" alt="{{ $selectedRecipe->name }}" class="rounded-lg object-cover h-64 w-full mb-6">
                        @endif
                    @else
                        <div class="h-64 bg-[#d9d7cc] mb-6 rounded-lg flex items-center justify-center text-[#7a7a58]">Sem Imagem</div>
                    @endif

                    <p class="text-base text-[#7a7a58] mb-6"><strong>Descrição:</strong> {{ $selectedRecipe->description }}</p>

                    <h3 class="font-bold text-xl text-[#556b2f] mb-4">Ingredientes:</h3>
                    <ul class="list-disc list-inside text-[#7a7a58] mb-6 space-y-3">
                        @forelse($selectedRecipe->ingredients as $ingredientProduct)
                            <li>
                                <span class="font-semibold">{{ $ingredientProduct->pivot->quantity_unit }} de {{ $ingredientProduct->name }}</span>

                                <select wire:model="selectedStorePerIngredient.{{ $ingredientProduct->id }}"
                                        class="ml-4 border border-[#a7b48c] rounded-md p-1 text-sm text-[#556b2f] inline-block w-auto min-w-[200px]">
                                    <option value="">Selecciona tienda</option>
                                    @forelse($ingredientProduct->stores as $store)
                                        @php
                                            $storeProduct = \App\Models\StoreProduct::where('product_id', $ingredientProduct->id)
                                                                                     ->where('store_id', $store->id)
                                                                                     ->first();
                                            $stockText = $storeProduct && $storeProduct->stock > 0 ? " (Estoque: {$storeProduct->stock})" : " (Esgotado)";
                                            $isDisabled = ($storeProduct && $storeProduct->stock == 0) ? 'disabled' : '';
                                        @endphp
                                        <option value="{{ $store->id }}" {{ $isDisabled }}>
                                            {{ $store->name }} - S/ {{ number_format($store->pivot->price, 2) }} {{ $stockText }}
                                        </option>
                                    @empty
                                        <option value="" disabled>Nenhuma loja para este ingrediente</option>
                                    @endforelse
                                </select>
                                <input type="number" min="1" wire:model.live="quantitiesPerIngredient.{{ $ingredientProduct->id }}"
                                       value="{{ (float) filter_var($ingredientProduct->pivot->quantity_unit, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) }}"
                                       class="ml-2 w-20 border border-[#a7b48c] rounded-md p-1 text-center text-sm text-[#556b2f]" />
                            </li>
                        @empty
                            <li>No hay ingredientes para esta receta.</li>
                        @endforelse
                    </ul>

                    <h3 class="font-bold text-xl text-[#556b2f] mb-4">Instruções:</h3>
                    <div class="text-[#7a7a58] mb-6 prose max-w-none">
                        <p>{!! nl2br(e($selectedRecipe->instructions)) !!}</p>
                    </div>

                    <div class="mt-6 flex justify-end gap-4">
                        <button wire:click="addToCartAllIngredients"
                                class="bg-[#8f9779] hover:bg-[#a4b07a] text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-300 shadow">
                            Adicionar Todos os Ingredientes ao Carrinho
                        </button>
                        <button wire:click="closeRecipeModal"
                                class="bg-[#c94f1a] hover:bg-[#a43b0e] text-white font-semibold py-3 px-6 rounded-lg shadow transition-colors duration-300">
                            Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>