<div>	
    <div class="table-title">
        <div class="row">
            <div class="col-sm-2">
                <div class="show-entries">
                    <select id="selectCantidad" class="form-select" wire:model="perPage" >
                        <option>10</option>
                        <option>15</option>
                        <option>20</option>
                        <option>50</option>
                    </select>
                </div>				
            </div>

            <div class="col-sm-6 d-flex align-items-center">
                <span>registros por página</span>				
            </div>

            <div class="col-sm-4">
                <div class="search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar..." wire:model.debounce.300ms="search">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Be like water. --}}
    <table id="" class="table table-hover">
        <thead>
            <tr>
                <th>{{__('ID')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Description')}}</th>
                <th>{{__('Proveedor')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
        </thead>
        
        <tfoot>
            <tr>
                <th>{{__('ID')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Description')}}</th>
                <th>{{__('Proveedor')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
        </tfoot>
        
        <tbody>
            @forelse($sistemas as $sistema)
            <tr>
                <td>{{trim($sistema->id)}}</td>
                <td>{{trim($sistema->nombre)}}</td>
                <td>{{trim($sistema->descripcion)}}</td>
                <td>{{trim($sistema->proveedor?->nombre)}}</td>
                <td>
                    <button type="button" 
                            class="btn btn-sm btn-icon btn-teal" 
                            data-toggle="tooltip" 
                            data-placement="top" 
                            title="Puede reportar">
                        <x-feathericon-edit/>
                    </button> &nbsp;
                    

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6"><div class="badge bg-primary text-white rounded-pill">Sin datos que mostrar</div></td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $sistemas->links() }}
</div>
