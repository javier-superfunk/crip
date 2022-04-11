<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TablaUsuarios extends Component
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
        return view('livewire.tabla-usuarios', [
            'usuarios' => User::buscar($this->search)
                                    ->orderBy('name')
                                    ->paginate($this->perPage),
        ]);
    }
}
