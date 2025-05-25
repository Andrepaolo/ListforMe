<div class="p-6 bg-gray-100 min-h-screen">
    

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Coluna Esquerda: Mapa --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-6 border border-[#e2dfd3]">
            <h2 class="text-2xl font-bold text-[#556b2f] mb-5">Localizar Lojas no Mapa</h2>
            {{-- ¡wire:ignore es CRÍTICO para que Livewire no destruya el mapa! --}}
            <div id="mapid" class="rounded-lg" wire:ignore></div>
        </div>

        {{-- Coluna Direita: Formulário e Cards de Lojas --}}
        <div class="lg:col-span-1 flex flex-col gap-8">
            {{-- Formulário para criar/editar loja --}}
            <div class="bg-white rounded-xl shadow-md p-6 border border-[#e2dfd3]">
                <h2 class="text-2xl font-bold text-[#556b2f] mb-5">{{ $isEditing ? 'Editar Loja' : 'Criar Nova Loja' }}</h2>

                <form wire:submit.prevent="saveStore" class="space-y-4">
                    <div>
                        <x-label for="name" value="Nome da Loja" class="text-[#556b2f]" />
                        <x-input id="name" type="text" class="mt-1 block w-full border-[#a7b48c] focus:border-[#8f9779] focus:ring focus:ring-[#8f9779] focus:ring-opacity-50 text-[#556b2f]" wire:model="name" />
                        <x-input-error for="name" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="location" value="Endereço / Descrição" class="text-[#556b2f]" />
                        <x-input id="location" type="text" class="mt-1 block w-full border-[#a7b48c] focus:border-[#8f9779] focus:ring focus:ring-[#8f9779] focus:ring-opacity-50 text-[#556b2f]" wire:model="location" />
                        <x-input-error for="location" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="latitud" value="Latitude (Clique no mapa para definir)" class="text-[#556b2f]" />
                        <x-input id="latitud" type="text" class="mt-1 block w-full bg-gray-50 cursor-not-allowed border-[#a7b48c] focus:border-[#8f9779] focus:ring focus:ring-[#8f9779] focus:ring-opacity-50 text-[#556b2f]" wire:model="latitud" readonly />
                        <x-input-error for="latitud" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="longitude" value="Longitude (Clique no mapa para definir)" class="text-[#556b2f]" />
                        <x-input id="longitude" type="text" class="mt-1 block w-full bg-gray-50 cursor-not-allowed border-[#a7b48c] focus:border-[#8f9779] focus:ring focus:ring-[#8f9779] focus:ring-opacity-50 text-[#556b2f]" wire:model="longitude" readonly />
                        <x-input-error for="longitude" class="mt-2" />
                    </div>

                    <div class="flex justify-end gap-4 mt-4">
                        <x-button type="submit" class="bg-[#556b2f] hover:bg-[#425823] text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-300">
                            {{ $isEditing ? 'Atualizar Loja' : 'Salvar Nova Loja' }}
                        </x-button>
                        @if ($isEditing)
                            <button type="button" wire:click="resetForm" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition-colors duration-300">
                                Cancelar Edição
                            </button>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Busca para las tarjetas --}}
            <div class="bg-white rounded-xl shadow-md p-6 border border-[#e2dfd3]">
                <h2 class="text-2xl font-bold text-[#556b2f] mb-5">Suas Lojas</h2>
                <div class="mb-4">
                    <x-input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar lojas..." class="w-full border-[#a7b48c] focus:border-[#8f9779] focus:ring focus:ring-[#8f9779] focus:ring-opacity-50 text-[#556b2f]" />
                </div>
                {{-- Lista de tiendas en formato de tarjeta --}}
                <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2"> {{-- Altura máxima y scroll para las tarjetas --}}
                    @forelse ($storesForCards as $store)
                        <div class="bg-[#fdf6e3] rounded-lg shadow-sm p-4 border border-[#e2dfd3] hover:shadow-md transition-shadow duration-200">
                            <h3 class="text-lg font-bold text-[#556b2f] mb-2">{{ $store->name }}</h3>
                            <p class="text-sm text-[#7a7a58] mb-1">{{ $store->location }}</p>
                            <p class="text-xs text-gray-500">Lat: {{ $store->latitud }}, Lon: {{ $store->longitude }}</p>

                            <div class="mt-4 flex flex-wrap gap-2 justify-end">
                                <button wire:click="editStore({{ $store->id }})" class="text-sm px-4 py-2 bg-[#8f9779] hover:bg-[#a4b07a] text-white rounded-md transition-colors duration-300">
                                    Editar
                                </button>
                                <button wire:click="deleteStore({{ $store->id }})" class="text-sm px-4 py-2 bg-[#c94f1a] hover:bg-[#a43b0e] text-white rounded-md transition-colors duration-300" onclick="confirm('Tem certeza que deseja excluir esta loja?') || event.stopImmediatePropagation()">
                                    Excluir
                                </button>
                                <button wire:click="openStockManager({{ $store->id }})" class="text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors duration-300">
                                    Gerenciar Estoque
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-[#7a7a58] text-center">Nenhuma loja encontrada. Crie uma!</p>
                    @endforelse
                </div>
                <div class="mt-4">
                    {{ $storesForCards->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Script JS para Leaflet --}}
    @script
    <script>
        let map;
        let selectionMarker; // Marcador para la selección de ubicación (azul por defecto)
        let storeMarkersLayerGroup; // Grupo para manejar los marcadores de tiendas (rojos o verde)
        let editingStoreId = null; // Variable para almacenar el ID de la tienda que se está editando

        // Coordenadas de Cachoeira, Bahia, Brasil
        const initialLat = -12.603013;
        const initialLon = -38.965074;
        const defaultZoom = 13;

        // Iconos personalizados con colores tierra y sombra
        const defaultIcon = L.icon({
            iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        const editingIcon = L.icon({
            iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        const selectionIcon = L.icon({
            iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Función de inicialización del mapa
        function initializeLeafletMap() {
            const mapContainer = document.getElementById('mapid');
            if (!mapContainer) {
                console.error('Error: Contenedor del mapa #mapid no encontrado.');
                return;
            }

            // Solo inicializar el mapa si no existe para evitar múltiples instancias
            if (!map) {
                map = L.map('mapid').setView([initialLat, initialLon], defaultZoom);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                storeMarkersLayerGroup = L.layerGroup().addTo(map);

                // Listener para click en el mapa para obtener coordenadas
                map.on('click', function(e) {
                    if (selectionMarker) {
                        selectionMarker.setLatLng(e.latlng);
                    } else {
                        selectionMarker = L.marker(e.latlng, { icon: selectionIcon }).addTo(map);
                    }
                    @this.setCoordinates(e.latlng.lat, e.latlng.lng);
                });
            }

            // Forzar un refresco del tamaño del mapa, esto es CRÍTICO cuando el contenedor cambia de tamaño
            map.invalidateSize();
            // La carga inicial de marcadores se hará a través del evento 'storeMarkersUpdated'
            // que se dispara al inicio del componente o por DOMContentLoaded.
        }

        // Función para cargar los marcadores de tiendas existentes
        function loadStoreMarkers(storesData, currentEditingStoreId) {
            if (!map || !storeMarkersLayerGroup) {
                console.warn('Mapa o grupo de marcadores no inicializado al cargar marcadores de tiendas.');
                return;
            }

            storeMarkersLayerGroup.clearLayers(); // Limpiar marcadores viejos

            storesData.forEach(store => {
                if (store.latitud && store.longitude) {
                    // console.log(`Processing store ID: ${store.id}, currentEditingStoreId: ${currentEditingStoreId}, Is editing: ${store.id === currentEditingStoreId}`);
                    const iconToUse = (store.id === currentEditingStoreId) ? editingIcon : defaultIcon;
                    const storeMarker = L.marker([store.latitud, store.longitude], { icon: iconToUse });
                    storeMarker.bindPopup(`<b>${store.name}</b><br>${store.location || ''}`);
                    storeMarkersLayerGroup.addLayer(storeMarker);
                }
            });
            map.invalidateSize(); // Forzar redibujado de marcadores
        }

        // --- Livewire Event Listeners ---

        // Nuevo evento central para actualizar los marcadores de las tiendas
        Livewire.on('storeMarkersUpdated', (storesJson, editingId) => {
            console.log('Evento storeMarkersUpdated recibido. Stores:', storesJson, 'Editing ID:', editingId);
            editingStoreId = editingId; // Actualizar la variable de edición en JS
            const storesArray = JSON.parse(storesJson); // Parsear el JSON a un array de objetos
            loadStoreMarkers(storesArray, editingId);

            // Lógica para el selectionMarker (el azul)
            if (editingId && storesArray.some(s => s.id === editingId && s.latitud && s.longitude)) {
                 const editedStore = storesArray.find(s => s.id === editingId);
                 if (selectionMarker) {
                     selectionMarker.setLatLng([editedStore.latitud, editedStore.longitude]);
                     selectionMarker.setIcon(selectionIcon);
                 } else {
                     selectionMarker = L.marker([editedStore.latitud, editedStore.longitude], { icon: selectionIcon }).addTo(map);
                 }
                 map.setView([editedStore.latitud, editedStore.longitude], defaultZoom);
            } else if (selectionMarker && !editingId) {
                // Si no hay tienda en edición y hay un selectionMarker, lo removemos
                map.removeLayer(selectionMarker);
                selectionMarker = null;
            }
        });


        // Evento Livewire para centrar el mapa en la tienda a editar
        // Este evento ahora solo se enfoca en mover el mapa y el marcador de selección.
        Livewire.on('setMapCenter', (lat, lon) => {
            if (map) {
                map.setView([lat, lon], defaultZoom);
                // Mueve el marcador de SELECCIÓN a la posición de la tienda a editar
                if (selectionMarker) {
                    selectionMarker.setLatLng([lat, lon]);
                    selectionMarker.setIcon(selectionIcon); // Asegura que el marcador de selección sea azul
                } else {
                    selectionMarker = L.marker([lat, lon], { icon: selectionIcon }).addTo(map);
                }
                map.invalidateSize();
            }
        });

        // Este evento se dispara cuando Livewire resetea el formulario
        Livewire.on('clearSelectionMarker', () => {
            if (selectionMarker) {
                map.removeLayer(selectionMarker);
                selectionMarker = null;
            }
        });

        // Este evento se dispara cuando Livewire establece el ID de la tienda en edición (o a null)
        Livewire.on('setEditingStoreId', (storeId) => {
            editingStoreId = storeId;
            // No es necesario llamar loadStoreMarkers aquí directamente,
            // el evento 'storeMarkersUpdated' se encargará de esto con los datos frescos.
            if (storeId === null && selectionMarker) {
                // Si ya no estamos editando, remover el marcador de selección
                map.removeLayer(selectionMarker);
                selectionMarker = null;
            }
        });


        // --- Inicialización del Mapa ---

        // Hook de Livewire para asegurar que el mapa se inicialice
        // y para cargar los marcadores iniciales al cargar el componente
        Livewire.hook('component.init', ({ component, cleanup }) => {
            if (component.name === 'store-manager') {
                setTimeout(() => {
                    initializeLeafletMap();
                    // Disparar el evento con los datos iniciales de las tiendas
                    const initialStores = @json($stores->toArray()); // Convertir a array explícitamente
                    @this.dispatch('storeMarkersUpdated', JSON.stringify(initialStores), null);
                }, 10);
            }
        });

        // Listener para DOMContentLoaded como fallback y para asegurar la primera carga
        document.addEventListener('DOMContentLoaded', () => {
             // Esto es un respaldo si el Livewire.hook no se dispara a tiempo,
             // pero el hook debería ser suficiente para la primera carga en Livewire v3.
             // Aquí no necesitamos pasar los datos si el hook ya lo hace.
             initializeLeafletMap();
             // Si quieres asegurar la carga inicial aquí también, duplica la lógica de dispatch
             // pero el hook 'component.init' es el preferido para componentes Livewire.
        });

    </script>
    @endscript

</div>