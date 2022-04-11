<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sistemas;
use Livewire\WithPagination;

class TablaReportaSistema extends Component
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
        return view('livewire.tabla-reporta-sistema', [
            'sistemas' => Sistemas::buscar($this->search)
                                        ->orderBy('nombre')
                                        ->paginate($this->perPage),
        ]);
    }
}
