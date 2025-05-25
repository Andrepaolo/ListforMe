<?php

namespace App\Livewire;

use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;

class StoreManager extends Component
{
    use WithPagination;

    public $name;
    public $location;
    public $latitud;
    public $longitude;
    public $storeId; // Para almacenar el ID de la tienda que se está editando
    public $isEditing = false; // Bandera para saber si estamos en modo edición

    public $search = ''; // Propiedad para el campo de búsqueda

    // Validaciones
    protected $rules = [
        'name' => 'required|string|min:3',
        'location' => 'required|string|min:5',
        'latitud' => 'required|numeric',
        'longitude' => 'required|numeric',
    ];

    // Listeners para los eventos de JavaScript
    protected $listeners = ['setCoordinates', 'setMapCenter', 'clearSelectionMarker']; // Mantenemos clearSelectionMarker aquí

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function setCoordinates($lat, $lon)
    {
        $this->latitud = $lat;
        $this->longitude = $lon;
    }

    public function saveStore()
    {
        $this->validate();

        if ($this->isEditing) {
            $store = Store::find($this->storeId);
            if ($store) {
                $store->update([
                    'name' => $this->name,
                    'location' => $this->location,
                    'latitud' => $this->latitud,
                    'longitude' => $this->longitude,
                ]);
                session()->flash('alert', ['type' => 'success', 'title' => 'Loja atualizada com sucesso!']);
            }
        } else {
            Store::create([
                'name' => $this->name,
                'location' => $this->location,
                'latitud' => $this->latitud,
                'longitude' => $this->longitude,
            ]);
            session()->flash('alert', ['type' => 'success', 'title' => 'Loja criada com sucesso!']);
        }

        $this->resetForm(); // Limpiar el formulario
        // Disparar evento para que JS recargue marcadores con los datos actualizados
        // Le pasamos el array completo de tiendas y el ID de la tienda que se está editando (o null si no).
        // Forzamos la actualización de la propiedad `stores` en el `render` para que Livewire tenga los datos frescos.
        $this->dispatch('storeMarkersUpdated', json_encode(Store::all()->toArray()), null);
    }

    public function editStore($id)
    {
        $store = Store::find($id);
        if ($store) {
            $this->storeId = $store->id;
            $this->name = $store->name;
            $this->location = $store->location;
            $this->latitud = $store->latitud;
            $this->longitude = $store->longitude;
            $this->isEditing = true;

            // Disparar evento para centrar el mapa y mostrar el marcador de edición
            $this->dispatch('setMapCenter', $store->latitud, $store->longitude);
            // Disparar un evento para que JS actualice el ID de la tienda en edición
            $this->dispatch('setEditingStoreId', $store->id);
            // Recargar todos los marcadores con el nuevo estado de edición
            $this->dispatch('storeMarkersUpdated', json_encode(Store::all()->toArray()), $store->id);
        }
    }

    public function deleteStore($id)
    {
        Store::destroy($id);
        session()->flash('alert', ['type' => 'success', 'title' => 'Loja excluída com sucesso!']);
        $this->resetForm(); // Limpiar el formulario y el estado de edición
        // Recargar marcadores después de eliminar
        $this->dispatch('storeMarkersUpdated', json_encode(Store::all()->toArray()), null);
    }

    public function resetForm()
    {
        $this->reset(['name', 'location', 'latitud', 'longitude', 'storeId', 'isEditing']);
        // Disparar eventos para que JS limpie el marcador de selección y el estado de edición
        $this->dispatch('clearSelectionMarker');
        $this->dispatch('setEditingStoreId', null);
        // Asegurarse de que los marcadores se recarguen con el estado no-edición
        $this->dispatch('storeMarkersUpdated', json_encode(Store::all()->toArray()), null);
    }

    public function openStockManager($storeId)
    {
        session()->flash('alert', ['type' => 'info', 'title' => 'Gerenciar estoque da loja ID: ' . $storeId]);
    }

    public function render()
    {
        // Filtrar tiendas por búsqueda
        $storesForCards = Store::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('location', 'like', '%' . $this->search . '%');
            })
            ->latest() // Ordenar por las más recientes
            ->paginate(5, ['*'], 'storesPage'); // Paginar los resultados para las tarjetas

        // Pasar también todas las tiendas para el mapa (sin paginación)
        // Esto asegura que todos los marcadores estén disponibles para JS
        $allStores = Store::all();

        return view('livewire.store-manager', [
            'storesForCards' => $storesForCards, // Para la lista de tarjetas
            'stores' => $allStores,     // Para los marcadores del mapa (usado en @json($stores) en blade)
        ])->layout('layouts.app');
    }
}
