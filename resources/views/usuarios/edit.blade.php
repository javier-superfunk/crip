@extends('layouts.dashboard')

{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        TITULO --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('titulo') {{ __('Users') }}  @endsection

{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        CSS             --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('css-scripts')
@endsection

{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        CONTENIDO --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('contenido')
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            @lang('Edit user') - {{$usuario->name}}
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        @if(session()->get('success') || session()->get('error') || $errors->any())
                            <a class="btn btn-sm btn-light text-primary active me-2" href="{{ route('usuarios.index') }}" >Atrás</a>
                        @else
                            <a class="btn btn-sm btn-light text-primary active me-2" href="{{ url()->previous() }}" >Atrás</a>
                        @endif
                        <!-- button class="btn btn-sm btn-light text-primary me-2">Month</button>
                        <button class="btn btn-sm btn-light text-primary">Year</button -->
                    </div>
                </div>
            </div>
        </div>
    </header>     
    <!-- Main page content-->
    <div class="container-fluid px-4">
        {{--  MANEJO DE RESPUESTAS - MENSAJES DEL CONTROLADOR --}}    
        @if(session()->get('success'))            
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif
        @if(session()->get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session()->get('error') }}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
        @endif

        <form action="{{route('usuarios.update',$usuario)}}" method="POST" x-data="{ mostrar_roles: '{{ ($roles_asignados->contains('proveedor') ? "P":"I") }}'}">                            
            
            @csrf
            
            @method('PATCH')
        
            <div class="row">            
            
                <div class="col-xl-6">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">@lang('Datos personales')</div>
                        <div class="card-body" >
                                
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="name">Nombre</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Ingrese su nombre" value="{{ old('name') ? old('name')  : $usuario->name }}" />
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" value="{{ old('email') ? old('email')  : $usuario->email }}" type="text" placeholder="Ingrese su segundo nombre" />
                                </div>
                            </div>

                            <div class="row gx-3 mb-3">
                                <label class="mb-1" for="tip_usuario">Tipo de usuario:</label>
                                <div class="btn-group mb-3" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="tip_usuario" id="btnradio-c" autocomplete="off" value="I"  x-model="mostrar_roles" {{ (!$roles_asignados->contains('proveedor') ? "checked":"") }} >
                                    <label class="btn btn-outline-primary" for="btnradio-c">Informante</label>
            
                                    <input type="radio" class="btn-check" name="tip_usuario" id="btnradio-p" autocomplete="off" value="P"  x-model="mostrar_roles" {{ ($roles_asignados->contains('proveedor') ? "checked":"") }} >
                                    <label class="btn btn-outline-primary" for="btnradio-p">Proveedor</label>                          
                                </div>
                            </div>
                            <template x-if=" mostrar_roles == 'I' ">
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="roles">@lang('Roles asignados')</label>
                                        @forelse($roles as $rol)
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="roles" name="roles[]" {{ ($roles_asignados->contains($rol->name) ? "checked":"") }} value="{{$rol->name}}">
                                            <label class="form-check-label" for="roles">{{$rol->name}}</label>
                                        </div>
                                        @endforeach
                                    </div> 
                                </div>
                            </template>

                            <template x-if=" mostrar_roles == 'P' ">
                                <div class="mb-3">
                                    <label for="proveedor" class="form-label">Proveedor:</label>
                                    <select class="form-select" aria-label="Proveedor" id="proveedor" name="proveedor">
                                        <option>Seleccione ...</option>
                                        @forelse($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id}}"  {{($usuario->proveedor[0]->id ?? null) == $proveedor->id ? "selected" : ""}}>{{ $proveedor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </template>

                            <!-- Save changes button-->
                            <button type="submit" class="btn btn-primary">@lang('Save changes')</button>
                        </div>
                    </div>                
                    
                </div>

                <div class="col-xl-6">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">@lang('Datos laborales')</div>
                        <div class="card-body">

                            

                            <!-- Save changes button-->
                            <button type="submit" class="btn btn-primary">@lang('Save changes')</button>
                        </div>
                    </div>
                </div>
            </div>
            @if ( !$roles_asignados->contains('proveedor') )
            <div class="row" x-show="mostrar_roles == 'I'"  x-transition>
                {{-- :::::::::::::::::::::: --}}
                <div class="col-lg-12 mb-4">
                    <div class="card mb-4 card-header-actions">
                        <div class="card-header">
                            Listado de sistemas
                        </div>
                        <div class="card-body">
                            <livewire:tabla-reporta-sistema>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </form>
        
    </div>
</main>
@endsection
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        JS              --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('js-scripts')
@endsection