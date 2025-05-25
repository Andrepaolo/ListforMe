<div class="p-6 space-y-8 bg-[#f5f0e6] min-h-screen">

    {{-- Categorias --}}
    <div class="flex flex-wrap gap-5 justify-center">
        {{-- INÍCIO: Botão "Todas" para limpar o filtro de categoria --}}
        <button wire:click="filterByCategory(null)"
            class="flex flex-col items-center justify-center w-28 h-28 rounded-xl shadow-md
                {{ is_null($selectedCategory) ? 'bg-[#8f9779] text-white' : 'bg-[#dde6d1] hover:bg-[#c5d1b3] text-[#556b2f]' }}
                border border-[#a7b48c] transition-colors duration-300">
            <div class="text-4xl mb-2"><i class="fas fa-boxes"></i></div> {{-- Ícone para "Todas" --}}
            <span class="text-base font-semibold">Todas</span>
        </button>
        {{-- FIM: Botão "Todas" --}}

        @foreach($categories as $category)
            <button wire:click="filterByCategory({{ $category->id }})"
                class="flex flex-col items-center justify-center w-28 h-28 rounded-xl shadow-md
                    {{ $selectedCategory == $category->id ? 'bg-[#8f9779] text-white' : 'bg-[#dde6d1] hover:bg-[#c5d1b3] text-[#556b2f]' }}
                    border border-[#a7b48c] transition-colors duration-300">
                <div class="text-4xl mb-2">
                    {{-- INÍCIO: Lógica para mostrar os ícones de categoria --}}
                    @if(isset($categoryIcons[$category->name]))
                        <i class="{{ $categoryIcons[$category->name] }}"></i>
                    @else
                        🍃 {{-- Ícone padrão se não for encontrado no array --}}
                    @endif
                    {{-- FIM: Lógica para mostrar os ícones de categoria --}}
                </div>
                <span class="text-base font-semibold text-[#556b2f]">{{ $category->name }}</span>
            </button>
        @endforeach
    </div>

    {{-- Preferências e Produtos --}}
    <div class="flex flex-col md:flex-row gap-8 mt-6">

        {{-- Preferencias (Sidebar) --}}
        <aside class="w-full md:w-1/4 bg-[#e8e4d8] p-5 rounded-xl shadow border border-[#c8c5b7]">
            
            {{-- ¡NUEVO! Campo de Búsqueda por Lista (Textarea) --}}
            <div class="mb-6">
                <label for="search-list" class="font-semibold text-[#6b705c] mb-2 block text-lg">Sua Lista de Compras</label>
                <textarea 
                    id="search-list" 
                    wire:model.live.debounce.500ms="search" {{-- .debounce.500ms para dar tiempo a escribir varias líneas --}}
                    placeholder="Digite os produtos, um por linha:&#10;Leite&#10;Batatas&#10;Doritos"
                    rows="6" {{-- Altura inicial del textarea --}}
                    class="w-full border border-[#a7b48c] rounded-md p-3 text-[#556b2f] placeholder-[#7a7a58] focus:ring-[#8f9779] focus:border-[#8f9779] resize-y"
                ></textarea>
                <p class="text-xs text-[#7a7a58] mt-1">Cada produto em uma nova linha.</p>
            </div>

            <h3 class="font-semibold text-[#6b705c] mb-4 text-lg">Preferências</h3>
            <div class="flex flex-col space-y-3 text-[#7a7a58] text-sm">
                @foreach($preferences as $preference)
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" value="{{ $preference->id }}" wire:model="selectedPreferences" class="accent-[#8f9779]">
                        {{ $preference->name }}
                    </label>
                @endforeach
            </div>
            <button wire:click="applyFilters" 
                class="mt-6 bg-[#8f9779] hover:bg-[#a4b07a] text-white font-semibold w-full py-3 rounded-lg transition-colors duration-300 shadow">
                Filtrar
            </button>
            <button wire:click="clearFilters"
                class="mt-3 bg-red-500 hover:bg-red-600 text-white font-semibold w-full py-3 rounded-lg transition-colors duration-300 shadow">
                Limpar Filtros
            </button>
        </aside>

        {{-- Produtos --}}
        <section class="w-full md:w-3/4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-lg border border-[#d3d0c8] flex flex-col p-5">
                    {{-- Imagem --}}
                    @if($product->image)
                        @if(Str::startsWith($product->image, ['http://', 'https://']))
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="rounded-lg object-cover h-48 mb-4 w-full">
                        @elseif(file_exists(public_path('storage/' . $product->image)))
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-lg object-cover h-48 mb-4 w-full">
                        @else
                            <div class="h-48 bg-[#d9d7cc] mb-4 rounded-lg flex items-center justify-center text-[#7a7a58]">Imagem não encontrada</div>
                        @endif
                    @else
                        <div class="h-48 bg-[#d9d7cc] mb-4 rounded-lg flex items-center justify-center text-[#7a7a58]">Sem Imagem</div>
                    @endif

                    <h3 class="font-bold text-xl text-[#556b2f] mb-1">{{ $product->name }}</h3>
                    <p class="text-sm text-[#7a7a58] mb-3 flex-grow">{{ $product->description }}</p>
                    @if($product->preferences->count() > 0)
                        <p class="text-sm text-[#7a7a58] mb-3">
                            Preferências:
                            @foreach($product->preferences as $pref)
                                <span class="inline-block bg-[#e0f2f7] text-[#3182ce] px-2 py-0.5 rounded-full text-xs font-medium mr-1 mb-1">{{ $pref->name }}</span>
                            @endforeach
                        </p>
                    @endif

                    {{-- Adiciona .live para que a propriedade seja atualizada em tempo real --}}
                    <select wire:model.live="selectedStorePerProduct.{{ $product->id }}" 
                        class="border border-[#a7b48c] rounded-md p-2 mb-4 text-[#556b2f]">
                        <option value="">Selecione loja e preço</option>
                        @foreach($product->stores as $store)
                            <option value="{{ $store->id }}">
                                {{ $store->name }} - S/ {{ number_format($store->pivot->price, 2) }}
                            </option>
                        @endforeach
                    </select>

                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2">
                            {{-- wire:model.live para que a quantidade seja atualizada em tempo real --}}
                            <input type="number" min="1" wire:model.live="quantities.{{ $product->id }}" placeholder="1"
                                class="w-16 border border-[#a7b48c] rounded-md p-1 text-center text-[#556b2f]" />

                            <button 
                                {{-- Passa a quantidade de quantities --}}
                                wire:click="addToCart({{ $product->id }}, {{ $selectedStorePerProduct[$product->id] ?? 'null' }}, {{ $quantities[$product->id] ?? 1 }})"
                                class="flex-grow text-white font-semibold py-2 rounded-lg transition-colors duration-300 shadow
                                    {{ empty($selectedStorePerProduct[$product->id]) ? 'bg-[#c1c4b7] cursor-not-allowed' : 'bg-[#8f9779] hover:bg-[#a4b07a]' }}"
                                {{ empty($selectedStorePerProduct[$product->id]) ? 'disabled' : '' }}
                            >
                                Adicionar ao carrinho
                            </button>

                        </div>

                        <button wire:click="showProduct({{ $product->id }})" 
                            class="bg-[#556b2f] hover:bg-[#425823] text-white px-4 py-2 rounded-lg transition-colors duration-300 shadow">
                            Ver mais
                        </button>
                    </div>

                </div>
            @endforeach

            <div class="col-span-full">
                {{ $products->links() }}
            </div>
        </section>

    </div>

    {{-- Modal --}}
    @if($showModal && $selectedProductId)
        @php
            $selectedProduct = \App\Models\Product::with('preferences', 'category', 'stores')->find($selectedProductId);
        @endphp

        <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 px-4">
            <div class="bg-[#fdf6e3] rounded-2xl w-full max-w-4xl shadow-xl overflow-hidden relative">

                <div class="flex flex-col md:flex-row">

                    {{-- Imagem --}}
                    <div class="md:w-1/2 bg-[#e2dfd3] p-6 flex items-center justify-center">
                        @if($selectedProduct->image)
                            @if(Str::startsWith($selectedProduct->image, ['http://', 'https://']))
                                <img src="{{ $selectedProduct->image }}" alt="{{ $selectedProduct->name }}" class="rounded-lg max-h-[320px] object-contain">
                            @elseif(file_exists(public_path('storage/' . $selectedProduct->image)))
                                <img src="{{ asset('storage/' . $selectedProduct->image) }}" alt="{{ $selectedProduct->name }}" class="rounded-lg max-h-[320px] object-contain">
                            @else
                                <div class="h-48 bg-[#d9d7cc] w-full rounded-lg flex items-center justify-center text-[#7a7a58]">Imagem não encontrada</div>
                            @endif
                        @else
                            <div class="h-48 bg-[#d9d7cc] w-full rounded-lg flex items-center justify-center text-[#7a7a58]">Sem Imagem</div>
                        @endif
                    </div>

                    {{-- Detalhes --}}
                    <div class="md:w-1/2 p-8 flex flex-col justify-between">

                        <div>
                            <h2 class="text-3xl font-extrabold text-[#556b2f] mb-4">{{ $selectedProduct->name }}</h2>
                            <p class="text-base text-[#7a7a58] mb-5"><strong>Descrição:</strong> {{ $selectedProduct->description }}</p>
                            <p class="text-base text-[#7a7a58] mb-5"><strong>Categoria:</strong> {{ $selectedProduct->category->name ?? 'Sem categoria' }}</p>

                            @if($selectedProduct->preferences->count())
                                <p class="font-semibold text-[#8f9779] mb-2">Preferências:</p>
                                <ul class="list-disc list-inside text-[#7a7a58] mb-6">
                                    @foreach($selectedProduct->preferences as $pref)
                                        <li>{{ $pref->name }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            @if($selectedProduct->stores->count())
                                <p class="font-semibold text-[#8f9779] mb-2">Lojas disponíveis:</p>
                                {{-- Adiciona .live para que a propriedade seja atualizada em tempo real --}}
                                <select wire:model.live="selectedStoreInModal" 
                                    class="border border-[#a7b48c] rounded-md p-2 mb-4 text-[#556b2f] w-full">
                                    <option value="">Selecione loja e preço</option>
                                    @foreach($selectedProduct->stores as $store)
                                        <option value="{{ $store->id }}">
                                            {{ $store->name }} - S/ {{ number_format($store->pivot->price, 2) }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="flex items-center gap-3">
                                    {{-- wire:model.live para que a quantidade seja atualizada em tempo real --}}
                                    <input type="number" min="1" wire:model.live="modalQuantity" placeholder="1"
                                        class="w-20 border border-[#a7b48c] rounded-md p-1 text-center text-[#556b2f]" />

                                    {{-- Chama addToCartFromModal sem passar parâmetros --}}
                                    <button 
                                        wire:click="addToCartFromModal" 
                                        class="flex-grow bg-[#8f9779] hover:bg-[#a4b07a] text-white font-semibold py-3 rounded-lg transition-colors duration-300 shadow"
                                        {{-- O botão é habilitado se houver uma loja selecionada --}}
                                        @if(empty($selectedStoreInModal)) disabled @endif
                                    >
                                        Adicionar ao carrinho
                                    </button>
                                </div>

                            @endif
                        </div>

                        <div class="flex justify-between mt-8 text-[#556b2f] font-semibold">
                            <button wire:click="previousProduct" class="hover:underline">⟵ Anterior</button>
                            <button wire:click="nextProduct" class="hover:underline">Próximo ⟶</button>
                        </div>

                        <div class="mt-6 text-right">
                            <button wire:click="$set('showModal', false)" 
                                class="bg-[#c94f1a] hover:bg-[#a43b0e] text-white font-semibold px-5 py-2 rounded-lg shadow transition-colors duration-300">
                                Fechar
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    @endif

</div>