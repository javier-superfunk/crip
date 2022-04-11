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
                            data-bs-toggle="modal" 
                            data-bs-target="#editarSistemaModal" 
                            x-data 
                            x-on:click="$dispatch('editar-sistema', {nombre : '{{$sistema->nombre}}', descripcion: '{{$sistema->descripcion}}', estado: '{{$sistema->activo}}', proveedor: {{$sistema->proveedor?->id}}, url: '{{ route('sistemas.update', $sistema) }}'})" >
                        <x-feathericon-edit/>
                    </button> &nbsp;
                    
                    <button type="button" 
                            class="btn btn-sm btn-icon btn-red" 
                            data-bs-toggle="modal" 
                            data-bs-target="#eliminarSistemaModal" 
                            x-data 
                            x-on:click="$dispatch('eliminar-sistema', {nombre: '{{ $sistema->nombre }}', url:'{{ route('sistemas.destroy',$sistema) }}'})" >
                        <x-feathericon-trash-2/></button>&nbsp;

                    @if ($sistema->activo)
                    <a class="btn btn-sm btn-icon btn-pink" href="{{route('sistemas.cambiar-estado',$sistema)}}" > <x-feathericon-lock/> </a> &nbsp;
                    @else
                    <a class="btn btn-sm btn-icon btn-green" href="{{route('sistemas.cambiar-estado',$sistema)}}" > <x-feathericon-unlock/> </a> &nbsp;
                    @endif
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
