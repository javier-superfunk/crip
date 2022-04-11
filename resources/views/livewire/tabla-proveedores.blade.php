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
                <th>{{__('Email')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
        </thead>
        
        <tfoot>
            <tr>
                <th>{{__('ID')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Description')}}</th>
                <th>{{__('Email')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
        </tfoot>
        
        <tbody>
            @forelse($proveedores as $proveedor)
            <tr>
                <td>{{trim($proveedor->id)}}</td>
                <td>{{trim($proveedor->nombre)}}</td>
                <td>{{trim($proveedor->descripcion)}}</td>
                <td>{{trim($proveedor->email)}}</td>
                <td>
                    <button type="button" 
                            class="btn btn-sm btn-icon btn-teal" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editarProveedorModal" 
                            x-data 
                            x-on:click="$dispatch('editar-proveedor', { nombre: '{{$proveedor->nombre}}', descripcion: '{{$proveedor->descripcion}}', estado: '{{$proveedor->activo}}', email: '{{$proveedor->email}}', url: '{{ route('proveedores.update',$proveedor) }}'})">
                        <x-feathericon-edit/></button> &nbsp;
                    
                    <button type="button" 
                            class="btn btn-sm btn-icon btn-red" 
                            data-bs-toggle="modal" 
                            data-bs-target="#eliminarProveedorModal" 
                            x-data 
                            x-on:click="$dispatch('eliminar-proveedor', {nombre : '{{ $proveedor->nombre }}', url:'{{ route('proveedores.destroy',$proveedor) }}'})" >
                        <x-feathericon-trash-2/></button>&nbsp;
                    
                    <button type="button" 
                            class="btn btn-sm btn-icon btn-purple" 
                            data-bs-toggle="modal" 
                            data-bs-target="#verProveedorModal" 
                            x-data 
                            x-on:click="$dispatch('ver-proveedor', {nombre: '{{$proveedor->nombre}}', descripcion: '{{$proveedor->descripcion}}', estado: '{{$proveedor->activo}}', email: '{{$proveedor->email}}' })">
                        <x-feathericon-eye/></button> &nbsp;

                    @if ($proveedor->activo)
                    <a class="btn btn-sm btn-icon btn-pink" href="{{route('proveedores.cambiar-estado',$proveedor)}}" > <x-feathericon-lock/> </a> &nbsp;
                    @else
                    <a class="btn btn-sm btn-icon btn-green" href="{{route('proveedores.cambiar-estado',$proveedor)}}" > <x-feathericon-unlock/> </a> &nbsp;
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
    {{ $proveedores->links() }}
</div>
