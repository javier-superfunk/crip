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
                            @lang('Add user')
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

        <form action="{{route('usuarios.store')}}" method="POST" >                            
            
            @csrf
        
            <div class="row">            
            
                <div class="col-xl-6">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">@lang('Datos personales')</div>
                        <div class="card-body">
                                
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="pri_nombre">Primer nombre</label>
                                    <input class="form-control" id="pri_nombre" name="pri_nombre" type="text" placeholder="Ingrese su nombre" value="{{ old('pri_nombre') }}" required />
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="seg_nombre">Segundo nombre</label>
                                    <input class="form-control" id="seg_nombre" name="seg_nombre" value="{{ old('seg_nombre') }}" type="text" placeholder="Ingrese su segundo nombre" />
                                </div>
                            </div>
                            
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="pri_apellido">Primer apellido</label>
                                    <input class="form-control" id="pri_apellido" name="pri_apellido" value="{{ old('pri_apellido') }}" type="text" placeholder="Ingrese su apellido" required />
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="seg_apellido">Segundo apellido</label>
                                    <input class="form-control" id="seg_apellido" name="seg_apellido" value="{{ old('seg_apellido') }}" type="text" placeholder="Ingrese su segundo apellido"  />
                                </div>
                            </div>

                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="fec_nacimiento">Fecha de nacimiento</label>
                                    <input class="form-control" id="fec_nacimiento" name="fec_nacimiento" value="{{ old('fec_nacimiento') }}" type="date"  placeholder="Ingrese su fecha de cumpleaños" required />
                                </div>
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="nro_documento">Número de documento</label>
                                    <input class="form-control" id="nro_documento" name="nro_documento" value="{{ old('nro_documento') }}"  min="100000" type="number" placeholder="Ingrese su número de documento" required />
                                </div>
                            </div>
                            
                            <!-- Form Group (email address)-->
                            <div class="row gx-3 mb-3">
                                <div class="col-md-12">
                                    <label class="small mb-1" for="direccion">Dirección</label>
                                    <input class="form-control" id="direccion" name="direccion" value="{{old('direccion') }}" type="text" placeholder="Ingrese su dirección particular" required />
                                </div>
                            </div>

                            @livewire('lista-departamentos-distritos')
                            
                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="email">@lang('Email Address')</label>
                                    <input class="form-control" id="email" name="email" value="{{ old('email') }}" type="email" placeholder="Ingrese su dirección de correo" required />
                                </div>
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="telefono">@lang('Phone Number')</label>
                                    <input class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}" type="tel" placeholder="Ingrese su número de teléfono" required />
                                </div>
                            </div>
                        </div>
                    </div>                
                    
                </div>

                <div class="col-xl-6">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">@lang('Datos laborales')</div>
                        <div class="card-body">

                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="birthday">Fecha de ingreso al banco</label>
                                    <input class="form-control" id="fec_alt_laboral" name="fec_alt_laboral" value="{{ old('fec_alt_laboral') }}" type="date" />
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="fec_alta">Fecha de ingreso al sindicato</label>
                                    <input class="form-control" id="fec_alta" name="fec_alta" value="{{ old('fec_alta') }}" type="date"  />
                                </div>
                            </div>

                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="tel_laboral">Número de teléfono</label>
                                    <input class="form-control" id="tel_laboral" name="tel_laboral" value="{{ old('tel_laboral') }}" type="tel" placeholder="Ingrese su número de teléfono laboral" />
                                </div>

                                <!-- Form Group (location)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="ema_laboral">Email laboral</label>
                                    <input class="form-control" id="ema_laboral" name="ema_laboral" value="{{ old('ema_laboral') }}" type="email" placeholder="Ingrese su correo laboral"  />
                                </div>

                            </div>

                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="cod_oficina">@lang('Office')</label>
                                    <select class="form-select" aria-label="@lang('Office')" id="cod_oficina" name="cod_oficina">
                                        <option>Seleccione ...</option>
                                        @foreach($oficinas as $oficina)
                                            <option value="{{ $oficina->cod_oficina}}" {{ (old("cod_oficina") == $oficina->cod_oficina ? "selected":"") }}>{{ $oficina->nom_oficina }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                                
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="roles">@lang('Roles asignados')</label>
                                    @foreach($roles as $rol)
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="roles" name="roles[]" value="{{$rol->name}}">
                                        <label class="form-check-label" for="roles">{{$rol->name}}</label>
                                    </div>
                                    @endforeach
                                </div>         

                            </div>

                            <!-- Save changes button-->
                            <button type="submit" class="btn btn-primary">@lang('Create user')</button>
                        </div>
                    </div>
                </div>
            </div>
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