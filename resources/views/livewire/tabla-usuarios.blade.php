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
                <th>{{__('Name')}}</th>
                <th>{{__('Email')}}</th>
                <th>{{__('Roles')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
        </thead>
        
        <tfoot>
            <tr>
                <th>{{__('Name')}}</th>
                <th>{{__('Email')}}</th>
                <th>{{__('Roles')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
        </tfoot>
        
        <tbody>
            @forelse($usuarios as $usuario)
            <tr>
                <td>{{trim($usuario->name)}}</td>
                <td>{{trim($usuario->email)}}</td>
                @php
                    $es_proveedor = "N";
                @endphp 
                <td>
                    @foreach (json_decode($usuario->roles) as $rol)
                    <span class="badge bg-primary text-white rounded-pill">{{ $rol->name }}</span>&nbsp;
                    @php
                        if($rol->name == "proveedor"){
                            $es_proveedor = "S";
                        }
                    @endphp
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('usuarios.edit',$usuario) }}" class="btn btn-sm btn-icon btn-teal" >  <x-feathericon-edit/>  </a> &nbsp;
                    
                    <button type="button" 
                            class="btn btn-sm btn-icon btn-red" 
                            data-bs-toggle="modal" 
                            data-bs-target="#eliminarUsuarioModal" 
                            x-data 
                            x-on:click="$dispatch('eliminar-usuario', { nombre: '{{$usuario->name}}', url: '{{ route('usuarios.destroy',$usuario) }}' })"><x-feathericon-trash-2/></button>&nbsp;
                    
                    <button type="button" 
                            class="btn btn-sm btn-icon btn-purple" 
                            data-bs-toggle="modal" 
                            data-bs-target="#verUsuarioModal" 
                            x-data 
                            x-on:click="$dispatch('ver-usuario', {  nombre: '{{$usuario->name}}', email: '{{$usuario->email}}', proveedor: '{{ $es_proveedor }}', nomproveedor: '{{ $usuario->proveedor->first()?->nombre }}' })"

                        > <x-feathericon-eye/> </button>&nbsp;

                    @if ($usuario->activo)
                    <a class="btn btn-sm btn-icon btn-pink" href="{{route('usuarios.cambiar-estado',$usuario)}}" > <x-feathericon-lock/> </a> &nbsp;
                    @else
                    <a class="btn btn-sm btn-icon btn-green" href="{{route('usuarios.cambiar-estado',$usuario)}}" > <x-feathericon-unlock/> </a> &nbsp;
                    @endif
                    @if ($usuario->activo)
                    <button type="button" 
                            class="btn btn-sm btn-icon btn-warning" 
                            data-bs-toggle="modal" 
                            data-bs-target="#resetPasswordModal" 
                            x-data 
                            x-on:click="$dispatch('resetear-pass', { nombre: '{{$usuario->name}}', url: '{{ route('usuarios.restablecer-password',$usuario) }}' })"> <x-feathericon-key/> </button> &nbsp;
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
    {{ $usuarios->links() }}
</div>
