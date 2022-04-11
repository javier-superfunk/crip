<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ReferenciasGenerales;

class TablaReferenciasGenerales extends Component
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
        return view('livewire.tabla-referencias-generales', [
            'referencias' => ReferenciasGenerales::buscar($this->search)->orderBy('dominio')->paginate($this->perPage),
        ]);
    }
}
