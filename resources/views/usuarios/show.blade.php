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
                            {{$usuario->pri_nombre.' '.$usuario->pri_apellido}}
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary active me-2" href="{{ route('usuarios.index') }}" >Atrás</a>
                    </div>
                </div>
            </div>
        </div>
    </header>     
    <!-- Main page content-->
    <div class="container-fluid px-4">
        
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
                                <input class="form-control" id="pri_nombre" name="pri_nombre" type="text" value="{{ $usuario->pri_nombre }}" />
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="seg_nombre">Segundo nombre</label>
                                <input class="form-control" id="seg_nombre" name="seg_nombre" value="{{ $usuario->seg_nombre }}" type="text"  />
                            </div>
                        </div>
                        
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="pri_apellido">Primer apellido</label>
                                <input class="form-control" id="pri_apellido" name="pri_apellido" value="{{ $usuario->pri_apellido }}" type="text" />
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="seg_apellido">Segundo apellido</label>
                                <input class="form-control" id="seg_apellido" name="seg_apellido" value="{{ $usuario->seg_apellido }}" type="text" />
                            </div>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="fec_nacimiento">Fecha de nacimiento</label>
                                <input class="form-control dateselect" id="fec_nacimiento" name="fec_nacimiento" value="{{ $usuario->fec_nacimiento }}" type="date"  />
                            </div>
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="nro_documento">Número de documento</label>
                                <input class="form-control" id="nro_documento" name="nro_documento" value="{{ number_format($usuario->nro_documento,0,',','.') }}" />
                            </div>
                        </div>
                        
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="direccion">Dirección</label>
                            <input class="form-control" id="direccion" name="direccion" value="{{ $usuario->direccion}}" type="text" />
                        </div>
                        
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="email">@lang('Email Address')</label>
                                <input class="form-control" id="email" name="email" value="{{ $usuario->email }}" type="email" />
                            </div>
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="telefono">@lang('Phone Number')</label>
                                <input class="form-control" id="telefono" name="telefono" value="{{ $usuario->telefono }}" type="tel" />
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
                                <input class="form-control dateselect" id="fec_alt_laboral" name="fec_alt_laboral" value="{{ $usuario->fec_alt_laboral }}" type="date" />
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="fec_alta">Fecha de ingreso al sindicato</label>
                                <input class="form-control dateselect" id="fec_alta" name="fec_alta" value="{{ $usuario->fec_alta }}" type="date"  />
                            </div>
                        </div>

                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="tel_laboral">Número de teléfono</label>
                                <input class="form-control" id="tel_laboral" name="tel_laboral" value="{{ $usuario->tel_laboral }}" type="tel" />
                            </div>

                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="ema_laboral">Email laboral</label>
                                <input class="form-control" id="ema_laboral" name="ema_laboral" value="{{ $usuario->ema_laboral }}" type="email" />
                            </div>

                        </div>

                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="cod_oficina">@lang('Office')</label>
                                <input class="form-control" type="text" name="" id="" value="{{ $usuario->oficina->nom_oficina }}">
                            </div>
                                            
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="roles">@lang('Roles asignados')</label>
                                <ul class="list-group">
                                    @foreach ($usuario->getRoleNames() as $rol)
                                    <li class="list-group-item list-group-item-light">{{ $rol }}</li>
                                        
                                    @endforeach
                                </ul>
                            </div>         

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
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