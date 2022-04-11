@extends('layouts.dashboard')

{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        TITULO --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('titulo') {{ __('Referencias Generales') }}  @endsection

{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        CSS             --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('css-scripts')

@endsection

{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        CONTENIDO       --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('contenido')
<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        {{--  MANEJO DE RESPUESTAS - MENSAJES DEL CONTROLADOR --}}    
        @if(session()->get('success'))            
           <div class="alert alert-success alert-dismissible fade show" role="alert">
               {{ session()->get('success') }}
           </div>
       @endif
       @if(session()->get('error'))
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
           {{ session()->get('error') }}
       </div>
       @endif
       @if ($errors->any())
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
           <ul>
               @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
       @endif
        <!-- Custom page header alternative example-->
        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
            <div class="me-4 mb-3 mb-sm-0">
                <h1 class="mb-0">@lang('Referencias generales')</h1>
                <div class="small">
                    Pantalla de mantenimiento de referencias del sistema.
                </div>
            </div>
            <div >
                <button type="button" class="btn btn-success lift" data-bs-toggle="modal" data-bs-target="#nuevaReferenciaModal" ><i class="me-1" data-feather="plus-circle"></i> | Agregar referencia</button>&nbsp;
            </div>
        </div>
        
        <div class="row">
            {{-- :::::::::::::::::::::: --}}
            <div class="col-lg-12 mb-4">
                <div class="card mb-4 card-header-actions">
                    <div class="card-header">
                        Listado de referencias generales
                        <div class="dropdown no-caret">
                            <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical text-gray-500"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></button>
                            <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownMenuButton" style="">
                                <h6 class="dropdown-header">Acciones adicionales:</h6>
                                <a class="dropdown-item" target="_blank" href="#">Exportar archivo Excel</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <livewire:tabla-referencias-generales>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        MODALS          --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('modal')
<!-- :::NUEVA REFERENCIA:::: -->
<div class="modal fade" id="nuevaReferenciaModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="nuevaReferenciaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevaReferenciaLabel">Nueva referencia</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="create-ref-form" action="{{ route('referencias.store') }}" method="POST">
                @csrf

                <div class="modal-body" x-data="{selDominio: ''}">                        
                    <div class="mb-3" >
                        <label for="cargaNuevoDominio" class="form-label">{{__('Dominio existente')}}</label>
                        <select id="cargaNuevoDominio" class="form-select" name="dominio-combo" x-model="selDominio">
                            <option selected>Seleccione...</option>
                            <option value="nuevo" >Nuevo</option>
                            @forelse($dominios as $dominio)
                                <option value="{{ $dominio->dominio }}" >{{ $dominio->dominio }}</option>
                            @empty
                                No existen dominios definidos. 
                            @endforelse
                        </select>
                    </div>
                    <template x-if=" selDominio == 'nuevo' ">
                        <div class="mb-3" id="nuevoDominioInput">
                            <label for="nuevoDominio" class="form-label">Dominio:</label>
                            <input type="text" name="dominio" class="form-control" id="nuevoDominio" >
                        </div>
                    </template>
                    <div class="mb-3">
                        <label for="recipient-vmin" class="form-label">Valor mínimo:</label>
                        <input type="text" name="val_minimo" class="form-control" id="recipient-vmin">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-vmax" class="form-label">Valor máximo:</label>
                        <input type="text" name="val_maximo" class="form-control" id="recipient-vmax">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <input type="text" name="descripcion" class="form-control" id="descripcion">
                    </div>
                    <div class="mb-3">
                        <label for="codigo" class="form-label">Código:</label>
                        <input type="text" name="codigo" class="form-control" id="codigo">
                    </div>
                    <div class="mb-3">
                        <label for="referencia" class="form-label">Referencia:</label>
                        <input type="text" name="referencia" class="form-control" id="referencia">
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="env_correo" >
                            <label class="form-check-label" for="flexSwitchCheckDefault">Envía correo</label>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">@lang('Cancel')</button>                
                    <button type="submit" class="btn btn-primary">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ::::::: -->
<div class="modal fade" id="editarReferenciaModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editarReferenciaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" x-data="{referencia: {  dominio: 'd', val_minimo: 'm',  val_maximo: 'm',  codigo: 'c',  referencia: 'r',  env_correo: 0,  descripcion: 'd',  url: 'u' }}"  @editar-referencia.window="referencia = $event.detail">
            <div class="modal-header">
                <h5 class="modal-title" id="editarReferenciaLabel">Editar referencia</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form x-bind:action="referencia.url" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="modal-body"> 
                        <div class="mb-3">
                            <label for="emddominio" class="form-label">Dominio:</label>
                            <input type="text" class="form-control" name="dominio" :value="referencia.dominio" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="emddescripcion" class="form-label">Descripción:</label>
                            <input type="text" name="descripcion" class="form-control" :value="referencia.descripcion">
                        </div>
                        <div class="mb-3">
                            <label for="emdval_minimo" class="form-label">Valor mínimo:</label>
                            <input type="text" name="val_minimo" class="form-control" :value="referencia.val_minimo">
                        </div>
                        <div class="mb-3">
                            <label for="emdval_maximo" class="form-label">Valor máximo:</label>
                            <input type="text" name="val_maximo" class="form-control" :value="referencia.val_maximo">
                        </div>
                        <div class="mb-3">
                            <label for="emdcodigo" class="form-label">Código:</label>
                            <input type="text" name="codigo" class="form-control" :value="referencia.codigo">
                        </div>
                        <div class="mb-3">
                            <label for="emdreferencia" class="form-label">Referencia:</label>
                            <input type="text" name="referencia" class="form-control" :value="referencia.referencia">
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="env_correo" :checked="referencia.env_correo == 1 ? true : false">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Envía correo</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">@lang('Cancel')</button>
                    <button type="submit" class="btn btn-primary">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ::::::: -->
<div class="modal fade" id="verReferenciaModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="verReferenciaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" x-data="{referencia: {  dominio: 'd', val_minimo: 'm',  val_maximo: 'm',  codigo: 'c',  referencia: 'r',  env_correo: 0,  descripcion: 'd',  url: 'u' }}"  @ver-referencia.window="referencia = $event.detail">
            
            <div class="modal-header">
                <h5 class="modal-title" id="verReferenciaLabel">Detalles de referencia</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="modal-body"> 
                    <div class="mb-3">
                        <label for="emddominio" class="form-label">Dominio:</label>
                        <input type="text" class="form-control" name="dominio" :value="referencia.dominio" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="emddescripcion" class="form-label">Descripción:</label>
                        <input type="text" name="descripcion" class="form-control" :value="referencia.descripcion">
                    </div>
                    <div class="mb-3">
                        <label for="emdval_minimo" class="form-label">Valor mínimo:</label>
                        <input type="text" name="val_minimo" class="form-control" :value="referencia.val_minimo">
                    </div>
                    <div class="mb-3">
                        <label for="emdval_maximo" class="form-label">Valor máximo:</label>
                        <input type="text" name="val_maximo" class="form-control" :value="referencia.val_maximo">
                    </div>
                    <div class="mb-3">
                        <label for="emdcodigo" class="form-label">Código:</label>
                        <input type="text" name="codigo" class="form-control" :value="referencia.codigo">
                    </div>
                    <div class="mb-3">
                        <label for="emdreferencia" class="form-label">Referencia:</label>
                        <input type="text" name="referencia" class="form-control" :value="referencia.referencia">
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="env_correo" :checked="referencia.env_correo == 1 ? true : false">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Envía correo</label>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- ::::::: -->
<div class="modal fade" id="eliminarReferenciaModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="eliminarReferenciaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" x-data="{ referencia: {dominio:'dominio', descripcion:'descripcion', url:'url'} }" @eliminar-referencia.window="referencia = $event.detail">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarReferenciaLabel">Eliminar referencia</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>¿Está seguro que desea eliminar la rerefencia <strong><span x-html="referencia.descripcion"></span></strong> del dominio <strong><span x-html="referencia.dominio"></span></strong> del sistema?</p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">@lang('Cancel')</button>
                <form id="delete-ref-form"  x-bind:action="referencia.url" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-primary">@lang('Understood')</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        JS              --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('js-scripts')

@endsection