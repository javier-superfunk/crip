@extends('layouts.dashboard')

{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        TITULO --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('titulo') {{ __('Proveedores') }}  @endsection

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
                <h1 class="mb-0">@lang('Proveedores')</h1>
                <div class="small">
                    Pantalla de mantenimiento de proveedores.
                </div>
            </div>
            <div >
                <button type="button" class="btn btn-success lift" data-bs-toggle="modal" data-bs-target="#nuevoProveedorModal" ><i class="me-1" data-feather="plus-circle"></i> | Agregar proveedor</button>&nbsp;
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 1-->
                <div class="card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-primary mb-1">Cantidad de registros</div>
                                <div class="h5">{{$cantidad}}</div>
                                <!--div class="text-xs fw-bold text-success d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-up"></i>
                                    12%
                                </div-->
                            </div>
                            <div class="ms-2"><i data-feather="trending-up" class="feather feather-package feather-xl text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            {{-- :::::::::::::::::::::: --}}
            <div class="col-lg-12 mb-4">
                <div class="card mb-4 card-header-actions">
                    <div class="card-header">
                        Listado de proveedores
                        <div class="dropdown no-caret">
                            <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical text-gray-500"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></button>
                            <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownMenuButton" style="">
                                <h6 class="dropdown-header">Acciones adicionales:</h6>
                                <a class="dropdown-item" target="_blank" href="#">Exportar archivo Excel</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <livewire:tabla-proveedores>
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
<!-- :::NUEVO PROVEEDOR:::: -->
<div class="modal fade" id="nuevoProveedorModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="nuevoProveedorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoProveedorLabel">Nuevo Proveedor</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="nuevo-proveedor-form" action="{{ route('proveedores.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ingrese nombre" id="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion:</label>
                        <input type="text" name="descripcion" class="form-control" placeholder="Ingrese direccion de correo" id="descripcion" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Ingrese direccion de correo" id="email" required>
                    </div>
                    <div class="row gx-3 mb-3">
                        <label class="mb-1" for="estado">Estado:</label>
                        <div class="btn-group mb-3" role="group" aria-label="Estado del proveedor">
                            <input type="radio" class="btn-check" name="estado" id="btnradio-c" autocomplete="off" value="1" >
                            <label class="btn btn-outline-primary" for="btnradio-c">Activo</label>

                            <input type="radio" class="btn-check" name="estado" id="btnradio-p" autocomplete="off" value="0" >
                            <label class="btn btn-outline-primary" for="btnradio-p">Inactivo</label>                          
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
<!-- :::EDITAR PROVEEDOR:::: -->
<div class="modal fade" id="editarProveedorModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editProveedorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" x-data="{ proveedor:  {nombre: 'n', descripcion: 'd', estado: 'e', email: 'm', url: 'u'} }" @editar-proveedor.window="proveedor = $event.detail" >
            <div class="modal-header">
                <h5 class="modal-title" id="editProveedorLabel">Editar Proveedor</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="edit-prov-form" x-bind:action="proveedor.url" method="POST" >
                <div class="modal-body">
                    @csrf
                    @method('patch')
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ingrese nombre" id="nombre" required :value="proveedor.nombre">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion:</label>
                        <input type="text" name="descripcion" class="form-control" placeholder="Ingrese direccion de correo" id="descripcion" required :value="proveedor.descripcion">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Ingrese direccion de correo" id="email" required :value="proveedor.email" >
                    </div>
                    <div class="row gx-3 mb-3">
                        <label class="mb-1" for="estado">Estado:</label>
                        <div class="btn-group mb-3" role="group" aria-label="Estado del proveedor">
                            <input type="radio" class="btn-check" name="estado" id="btnradio-1" autocomplete="off" value="1" x-bind:checked="proveedor.estado == '1'">
                            <label class="btn btn-outline-primary" for="btnradio-1">Activo</label>

                            <input type="radio" class="btn-check" name="estado" id="btnradio-0" autocomplete="off" value="0" x-bind:checked="proveedor.estado == '0'">
                            <label class="btn btn-outline-primary" for="btnradio-0">Inactivo</label>                          
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
<!-- :::VER PROVEEDOR:::: -->
<div class="modal fade" id="verProveedorModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="verProveedorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verProveedorLabel">Detalles de proveedor</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body" x-data="{ proveedor:  {nombre: 'n', descripcion: 'd', estado: 'e', email: 'm'} }" @ver-proveedor.window="proveedor = $event.detail">                
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" :value="proveedor.nombre" >
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripcion:</label>
                    <input type="email" name="descripcion" class="form-control" :value="proveedor.descripcion" >
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" :value="proveedor.email" >
                </div>
                <div class="row gx-3 mb-3">
                    <label class="mb-1" for="estado">Estado:</label>
                    <div class="btn-group mb-3" role="group" aria-label="Estado del proveedor">
                        <input type="radio" class="btn-check" name="estado" id="btnradio-a" x-bind:checked="proveedor.estado == '1'">
                        <label class="btn btn-outline-primary" for="btnradio-a">Activo</label>

                        <input type="radio" class="btn-check" name="estado" id="btnradio-i" x-bind:checked="proveedor.estado == '0'" >
                        <label class="btn btn-outline-primary" for="btnradio-i">Inactivo</label>                          
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- :::ELIMINAR PROVEEDOR:::: -->
<div class="modal fade" id="eliminarProveedorModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="eliminarProveedorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"  x-data="{ proveedor: {nombre:'nombre', url:'url'} }" @eliminar-proveedor.window="proveedor = $event.detail">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarProveedorLabel">Eliminar Proveedor</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>¿Está seguro que desea eliminar al proveedor <strong><span x-html="proveedor.nombre"></span></strong> del sistema?</p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">@lang('Cancel')</button>
                <form id="delete-prov-form" x-bind:action="proveedor.url" method="POST">
                    @csrf
                    @method('DELETE')
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