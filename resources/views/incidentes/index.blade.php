@extends('layouts.dashboard')

{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        TITULO --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('titulo') {{ __('Incidentes') }}  @endsection

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
                <h1 class="mb-0">@lang('Incidentes')</h1>
                <div class="small">
                    Pantalla de mantenimiento de usuarios del sistema.
                </div>
            </div>
            <div >
                <button type="button" class="btn btn-success lift" data-bs-toggle="modal" data-bs-target="#nuevoUsuarioModal" ><i class="me-1" data-feather="plus-circle"></i> | Agregar usuario</button>&nbsp;
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 1-->
                <div class="card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-primary mb-1">Cantidad de usuarios</div>
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
                        Listado de usuarios del sistema
                        <div class="dropdown no-caret">
                            <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical text-gray-500"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></button>
                            <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownMenuButton" style="">
                                <h6 class="dropdown-header">Acciones adicionales:</h6>
                                <a class="dropdown-item" target="_blank" href="#">Exportar archivo Excel</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <livewire:tabla-usuarios>
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
<!-- :::NUEVO USUARIO:::: -->
<div class="modal fade" id="nuevoUsuarioModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="nuevoUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoUsuarioLabel">Nuevo usuario</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="nuevo-user-form" action="{{route('usuarios.store')}}" method="POST">
                <div class="modal-body" x-data="{proveedor: ''}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" name="name" class="form-control" placeholder="Ingrese nombre" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Ingrese direccion de correo" id="email" required>
                    </div>
                    <div class="row gx-3 mb-3">
                        <label class="mb-1" for="tip_usuario">Tipo de usuario:</label>
                        <div class="btn-group mb-3" role="group" aria-label="Tipo de usaurio">
                            <input type="radio" value="I" class="btn-check" id="btnradio-c" name="tip_usuario" x-model="proveedor"/>
                            <label class="btn btn-outline-primary" for="btnradio-c">Informante</label>

                            <input type="radio" value="P" class="btn-check" id="btnradio-p" name="tip_usuario" x-model="proveedor"/>
                            <label class="btn btn-outline-primary" for="btnradio-p">Proveedor</label>                          
                        </div>
                    </div> 
                    <template x-if=" proveedor == 'I' ">
                        <div class="row gx-3 mb-3" id="mostrarRoles">
                            <label class="mb-1" for="grupo_roles">Seleccione otros roles:</label><br/>
                            <div class="mb-3" role="group" aria-label="Seleccione roles" id="grupo_roles">
                                @foreach ($roles as $rol)   
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="roles" name="roles[]" value="{{ $rol->name }}">
                                    <label class="form-check-label" >{{ $rol->name }}</label>
                                </div>                                
                                @endforeach                          
                            </div>
                        </div>
                    </template>
                    <template x-if=" proveedor == 'P' ">
                        <div class="mb-3">
                            <label for="proveedor" class="form-label">Proveedor:</label>
                            <select class="form-select" aria-label="Proveedor" id="proveedor" name="proveedor">
                                <option>Seleccione ...</option>
                                @forelse($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id}}" >{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </template>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">@lang('Cancel')</button>                
                    <button type="submit" class="btn btn-primary">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- :::VER USUARIO:::: -->
<div class="modal fade" id="verUsuarioModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="verUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verUsuarioLabel">Detalles de usuario</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body"  x-data="{ usuario: {nombre:'n', email:'m', nomproveedor:'p', proveedor:'N'} }" @ver-usuario.window="usuario = $event.detail">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" class="form-control" :value="usuario.nombre" >
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" :value="usuario.email">
                </div>
                <div class="row gx-3 mb-3">
                    <label class="mb-1" for="tip_usuario">Tipo de usuario:</label>
                    <div class="btn-group mb-3" role="group" aria-label="Tipo de usuario">
                        <input type="radio" class="btn-check" name="tip_usuario" x-bind:checked="usuario.proveedor == 'N'">
                        <label class="btn btn-outline-primary" for="btnradio-c">Informante</label>

                        <input type="radio" class="btn-check" name="tip_usuario" x-bind:checked="usuario.proveedor == 'S'">
                        <label class="btn btn-outline-primary" for="btnradio-p">Proveedor</label>
                    </div>
                </div>
                <template x-if=" usuario.proveedor == 'S' ">
                    <div class="mb-3">
                        <label for="proveedor" class="form-label">Proveedor:</label>
                        <input type="text" name="proveedor" class="form-control" :value="usuario.nomproveedor">
                    </div>
                </template>
            </div>

        </div>
    </div>
</div>
<!-- :::ELIMINAR USUARIO:::: -->
<div class="modal fade" id="eliminarUsuarioModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="eliminarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" x-data="{ usuario: {nombre:'n', url:'n'} }" @eliminar-usuario.window="usuario = $event.detail">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarUsuarioLabel">Eliminar usuario</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>¿Está seguro que desea eliminar al usuario <strong><span x-html="usuario.nombre"></span></strong>?</p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">@lang('Cancel')</button>
                <form id="delete-user-form" x-bind:action="usuario.url" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">@lang('Understood')</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- :::RESET PASSWORD USUARIO:::: -->
<div class="modal fade" id="resetPasswordModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="resetPasswordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" x-data="{ usuario: {nombre:'nombre', url:'url'} }" @resetear-pass.window="usuario = $event.detail">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordLabel">Regenerar contraseña de usuario</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>¿Está seguro que desea regenerar la contraseña del usuario <strong><span x-html="usuario.nombre"></span></strong>?</p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">@lang('Cancel')</button>
                <form id="reset-user-form" x-bind:action="usuario.url" method="GET" >
                    @csrf
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