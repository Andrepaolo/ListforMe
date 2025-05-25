<div class="p-6 space-y-8 bg-[#f5f0e6] min-h-screen">
    <h1 class="text-4xl font-extrabold text-[#556b2f] text-center mb-8">Seu Carrinho de Compras</h1>

    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Seção do Carrinho (aprox. 60%) --}}
        <div class="lg:w-3/5 bg-[#fdf6e3] p-6 rounded-lg shadow-xl border border-[#c8c5b7]">
            <h2 class="text-2xl font-bold text-[#556b2f] mb-6 border-b pb-4">Detalhes do Carrinho</h2>

            @if (count($cartItems) > 0)
                <div class="space-y-6">
                    @foreach ($cartItems as $item)
                        <div class="flex flex-col sm:flex-row items-center justify-between bg-white p-4 rounded-lg shadow-md border border-[#d3d0c8]">
                            <div class="flex items-center space-x-4 mb-4 sm:mb-0 w-full sm:w-auto">
                                {{-- Imagem do produto --}}
                                @if($item->storeProduct->product->image)
                                    @if(Str::startsWith($item->storeProduct->product->image, ['http://', 'https://']))
                                        <img src="{{ $item->storeProduct->product->image }}" alt="{{ $item->storeProduct->product->name }}" class="w-16 h-16 object-cover rounded-md">
                                    @elseif(file_exists(public_path('storage/' . $item->storeProduct->product->image)))
                                        <img src="{{ asset('storage/' . $item->storeProduct->product->image) }}" alt="{{ $item->storeProduct->product->name }}" class="w-16 h-16 object-cover rounded-md">
                                    @else
                                        <div class="w-16 h-16 bg-[#d9d7cc] rounded-md flex items-center justify-center text-[#7a7a58] text-xs">Sem Img</div>
                                    @endif
                                @else
                                    <div class="w-16 h-16 bg-[#d9d7cc] rounded-md flex items-center justify-center text-[#7a7a58] text-xs">Sem Img</div>
                                @endif
                                <div>
                                    <h3 class="text-lg font-semibold text-[#556b2f]">
                                        {{ $item->storeProduct->product->name }}
                                    </h3>
                                    <p class="text-sm text-[#7a7a58]">
                                        Loja: {{ $item->storeProduct->store->name }}
                                    </p>
                                    <p class="text-sm text-[#7a7a58]">
                                        Preço Unitário: R$ {{ number_format($item->storeProduct->price, 2) }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4 w-full sm:w-auto justify-end">
                                <input
                                    type="number"
                                    min="1"
                                    value="{{ $item->quantity }}"
                                    wire:change="updateQuantity({{ $item->id }}, $event.target.value)"
                                    class="w-20 border border-[#a7b48c] rounded-md p-2 text-center text-[#556b2f]"
                                />
                                <span class="text-lg font-bold text-[#556b2f] min-w-[80px] text-right">
                                R$ {{ number_format($item->quantity * $item->storeProduct->price, 2) }}
                                </span>
                                <button wire:click="removeItem({{ $item->id }})" class="text-red-600 hover:text-red-800 text-xl ml-2">
                                    &times;
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 pt-4 border-t border-[#c8c5b7] flex justify-between items-center">
                    <span class="text-2xl font-bold text-[#556b2f]">Total:</span>
                    <span class="text-2xl font-bold text-[#c94f1a]">R$ {{ number_format($totalPrice, 2) }}</span>
                </div>

                <div class="mt-6 text-right">
                    <button class="bg-[#8f9779] hover:bg-[#a4b07a] text-white font-semibold py-3 px-6 rounded-lg shadow transition-colors duration-300">
                        Finalizar Compra
                    </button>
                </div>
            @else
                <p class="text-center text-[#7a7a58] text-lg py-10">Seu carrinho está vazio. Adicione alguns produtos!</p>
            @endif

            {{-- Seção de "Produtos não tão saudáveis" --}}
            @if (count($unhealthyProductsInCart) > 0)
                <div class="mt-12 bg-[#ffe8e8] p-6 rounded-lg shadow-xl border border-[#c8c5b7]">
                    <h3 class="text-2xl font-bold text-[#b30000] mb-6 border-b pb-4">Atenção! Seu carrinho inclui:</h3>
                    <p class="text-lg text-[#8b0000] mb-4">Considere adicionar opções mais saudáveis para equilibrar sua compra.</p>
                    <div class="space-y-4">
                        @foreach ($unhealthyProductsInCart as $unhealthyProduct)
                            <div class="flex items-center bg-white p-3 rounded-lg shadow-sm border border-[#e0b4b4]">
                                @if($unhealthyProduct['image'])
                                    @if(Str::startsWith($unhealthyProduct['image'], ['http://', 'https://']))
                                        <img src="{{ $unhealthyProduct['image'] }}" alt="{{ $unhealthyProduct['name'] }}" class="w-12 h-12 object-cover rounded-md mr-3">
                                    @elseif(file_exists(public_path('storage/' . $unhealthyProduct['image'])))
                                        <img src="{{ asset('storage/' . $unhealthyProduct['image']) }}" alt="{{ $unhealthyProduct['name'] }}" class="w-12 h-12 object-cover rounded-md mr-3">
                                    @else
                                        <div class="w-12 h-12 bg-[#d9d7cc] rounded-md flex items-center justify-center text-[#7a7a58] text-xs mr-3">Sem Img</div>
                                    @endif
                                @else
                                    <div class="w-12 h-12 bg-[#d9d7cc] rounded-md flex items-center justify-center text-[#7a7a58] text-xs mr-3">Sem Img</div>
                                @endif
                                <div class="flex-grow">
                                    <h4 class="font-semibold text-[#8b0000]">{{ $unhealthyProduct['name'] }} (x{{ $unhealthyProduct['quantity'] }})</h4>
                                    <p class="text-sm text-[#a04040]">Este produto não está marcado como saudável.</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Seção de Sugestões (aprox. 40%) --}}
        <div class="lg:w-2/5 bg-[#e8e4d8] p-6 rounded-lg shadow-xl border border-[#c8c5b7]">
            <h2 class="text-2xl font-bold text-[#6b705c] mb-6 border-b pb-4">Talvez você se interesse (Opções Saudáveis!)</h2>

            @if (count($healthySuggestions) > 0)
                <div class="space-y-4">
                    @foreach ($healthySuggestions as $suggestion)
                        <div class="flex items-center bg-white p-3 rounded-lg shadow-sm border border-[#d3d0c8]">
                            {{-- Imagem da sugestão --}}
                            @if($suggestion->image)
                                @if(Str::startsWith($suggestion->image, ['http://', 'https://']))
                                    <img src="{{ $suggestion->image }}" alt="{{ $suggestion->name }}" class="w-12 h-12 object-cover rounded-md mr-3">
                                @elseif(file_exists(public_path('storage/' . $suggestion->image)))
                                    <img src="{{ asset('storage/' . $suggestion->image) }}" alt="{{ $suggestion->name }}" class="w-12 h-12 object-cover rounded-md mr-3">
                                @else
                                    <div class="w-12 h-12 bg-[#d9d7cc] rounded-md flex items-center justify-center text-[#7a7a58] text-xs mr-3">Sem Img</div>
                                @endif
                            @else
                                <div class="w-12 h-12 bg-[#d9d7cc] rounded-md flex items-center justify-center text-[#7a7a58] text-xs mr-3">Sem Img</div>
                            @endif

                            <div class="flex-grow">
                                <h4 class="font-semibold text-[#556b2f]">{{ $suggestion->name }}</h4>
                                {{-- Seletor de loja para a sugestão --}}
                                @if($suggestion->stores->count())
                                    <select
                                        wire:model.live="selectedStorePerProduct.{{ $suggestion->id }}"
                                        class="border border-[#a7b48c] rounded-md p-1 text-sm mt-1 text-[#556b2f] w-full"
                                    >
                                        <option value="">Selecione a loja</option>
                                        @foreach($suggestion->stores as $store)
                                            <option value="{{ $store->id }}">
                                                {{ $store->name }} - S/ {{ number_format($store->pivot->price, 2) }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <p class="text-sm text-red-500">Não disponível em lojas</p>
                                @endif
                            </div>
                            <button
                                wire:click="addSuggestedProductToCart({{ $suggestion->id }}, '{{ $selectedStorePerProduct[$suggestion->id] ?? 'null' }}')"
                                class="bg-[#a4b07a] hover:bg-[#8f9779] text-white px-4 py-2 rounded-lg text-sm transition-colors duration-300 ml-3"
                                @if(empty($selectedStorePerProduct[$suggestion->id])) disabled @endif
                            >
                                Adicionar
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
