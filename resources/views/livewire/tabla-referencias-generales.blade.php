<div>	
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
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
                <th>{{__('Dominio')}}</th>
                <th>{{__('Valor mínimo')}}</th>
                <th>{{__('Descripcion')}}</th>
                <th>{{__('Código')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
        </thead>
        
        <tfoot>
            <tr>
                <th>{{__('Dominio')}}</th>
                <th>{{__('Valor mínimo')}}</th>
                <th>{{__('Descripcion')}}</th>
                <th>{{__('Código')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
        </tfoot>
        
        <tbody>
            @forelse($referencias as $referencia)
            <tr>
                <td>{{ $referencia->dominio }}</td>
                <td>{{ $referencia->val_minimo }}</td>
                <td>{{ $referencia->descripcion }}</td>
                <td>{{ $referencia->codigo }}</td>
                <td>
                    <button type="button" 
                            class="btn btn-sm btn-icon btn-teal" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editarReferenciaModal" 
                            x-data 
                            x-on:click="$dispatch('editar-referencia', { dominio: '{{$referencia->dominio}}', 
                                                                        val_minimo: '{{$referencia->val_minimo}}', 
                                                                        val_maximo: '{{$referencia->val_maximo}}', 
                                                                        codigo: '{{$referencia->codigo}}', 
                                                                        referencia: '{{$referencia->referencia}}', 
                                                                        env_correo: '{{$referencia->env_correo}}', 
                                                                        descripcion: '{{$referencia->descripcion}}', 
                                                                        url: '{{ route('referencias.update',$referencia->id) }}' })" > 
                        <x-feathericon-edit/>
                    </button>&nbsp;                    
                    
                    <button type="button" 
                            class="btn btn-sm btn-icon btn-red" 
                            data-bs-toggle="modal" 
                            data-bs-target="#eliminarReferenciaModal" 
                            x-data 
                            x-on:click="$dispatch('eliminar-referencia', {  dominio: '{{$referencia->dominio}}', 
                                                                            descripcion: '{{$referencia->descripcion}}', 
                                                                            url: '{{ route('referencias.destroy',$referencia->id) }}' })">
                        <x-feathericon-trash-2/>
                    </button>&nbsp;
                    
                    <button type="button" 
                            class="btn btn-sm btn-icon btn-purple" 
                            data-bs-toggle="modal" 
                            data-bs-target="#verReferenciaModal" 
                            x-data 
                            x-on:click="$dispatch('ver-referencia', { dominio: '{{$referencia->dominio}}', 
                                                                        val_minimo: '{{$referencia->val_minimo}}', 
                                                                        val_maximo: '{{$referencia->val_maximo}}', 
                                                                        codigo: '{{$referencia->codigo}}', 
                                                                        referencia: '{{$referencia->referencia}}', 
                                                                        env_correo: '{{$referencia->env_correo}}', 
                                                                        descripcion: '{{$referencia->descripcion}}' })"> 
                        <x-feathericon-eye/>
                    </button>&nbsp;
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6"><div class="badge bg-primary text-white rounded-pill">Sin datos que mostrar</div></td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {!! $referencias->links() !!}
</div>
