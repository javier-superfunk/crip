<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proveedores;
use Livewire\WithPagination;

class TablaProveedores extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.tabla-proveedores', [
            'proveedores' => Proveedores::buscar($this->search)
                                        ->orderBy('nombre')
                                        ->paginate($this->perPage),
        ]);
    }
}
