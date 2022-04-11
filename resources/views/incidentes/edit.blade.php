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
                            @lang('Edit user') - {{$usuario->pri_nombre.' '.$usuario->pri_apellido}}
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

        <form action="{{route('usuarios.update',$usuario)}}" method="POST" >                            
            
            @csrf
            
            @method('PATCH')
        
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
                                    <input type="radio" class="btn-check" name="tip_usuario" id="btnradio-c" autocomplete="off" value="I" >
                                    <label class="btn btn-outline-primary" for="btnradio-c">Informante</label>
            
                                    <input type="radio" class="btn-check" name="tip_usuario" id="btnradio-p" autocomplete="off" value="P" >
                                    <label class="btn btn-outline-primary" for="btnradio-p">Proveedor</label>                          
                                </div>
                            </div>
                            
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="pri_apellido">Primer apellido</label>
                                    <input class="form-control" id="pri_apellido" name="pri_apellido" value="{{ old('pri_apellido') ? old('pri_apellido')  : $usuario->pri_apellido }}" type="text" placeholder="Ingrese su apellido" required />
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="seg_apellido">Segundo apellido</label>
                                    <input class="form-control" id="seg_apellido" name="seg_apellido" value="{{ old('seg_apellido') ? old('seg_apellido')  : $usuario->seg_apellido }}" type="text" placeholder="Ingrese su segundo apellido"  />
                                </div>
                            </div>

                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="fec_nacimiento">Fecha de nacimiento</label>
                                    <input class="form-control" id="fec_nacimiento" name="fec_nacimiento" value="{{ old('fec_nacimiento') ? old('fec_nacimiento')  : $usuario->fec_nacimiento }}" type="date"  placeholder="Ingrese su fecha de cumpleaños" required />
                                </div>
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="nro_documento">Número de documento</label>
                                    <input class="form-control" id="nro_documento" name="nro_documento" value="{{ old('nro_documento') ? old('nro_documento')  : $usuario->nro_documento }}"  min="100000" type="number" placeholder="Ingrese su número de documento" required />
                                </div>
                            </div>
                            
                            <!-- Form Group (email address)-->
                            <div class="row gx-3 mb-3">
                                <div class="col-md-12">
                                    <label class="small mb-1" for="direccion">Dirección</label>
                                    <input class="form-control" id="direccion" name="direccion" value="{{old('direccion') ? old('direccion')  : $usuario->direccion}}" type="text" placeholder="Ingrese su dirección particular" required />
                                </div>
                            </div>

                            @livewire('lista-departamentos-distritos',[
                                'departamento' => $usuario->cod_departamento,
                                'ciudad' => $usuario->cod_distrito,
                            ])
                            
                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="email">@lang('Email Address')</label>
                                    <input class="form-control" id="email" name="email" value="{{ old('email') ? old('email')  : $usuario->email }}" type="email" placeholder="Ingrese su dirección de correo" required />
                                </div>
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="telefono">@lang('Phone Number')</label>
                                    <input class="form-control" id="telefono" name="telefono" value="{{ old('telefono') ? old('telefono')  : $usuario->telefono }}" type="tel" placeholder="Ingrese su número de teléfono" required />
                                </div>
                            </div>

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

                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="birthday">Fecha de ingreso al banco</label>
                                    <input class="form-control" id="fec_alt_laboral" name="fec_alt_laboral" value="{{ old('fec_alt_laboral') ? old('fec_alt_laboral')  : $usuario->fec_alt_laboral }}" type="date" />
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="fec_alta">Fecha de ingreso al sindicato</label>
                                    <input class="form-control" id="fec_alta" name="fec_alta" value="{{ old('fec_alta') ? old('fec_alta')  : $usuario->fec_alta }}" type="date"  />
                                </div>
                            </div>

                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="tel_laboral">Número de teléfono</label>
                                    <input class="form-control" id="tel_laboral" name="tel_laboral" value="{{ old('tel_laboral') ? old('tel_laboral')  : $usuario->tel_laboral }}" type="tel" placeholder="Ingrese su número de teléfono laboral" />
                                </div>

                                <!-- Form Group (location)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="ema_laboral">Email laboral</label>
                                    <input class="form-control" id="ema_laboral" name="ema_laboral" value="{{ old('ema_laboral') ? old('ema_laboral')  : $usuario->ema_laboral }}" type="email" placeholder="Ingrese su correo laboral"  />
                                </div>

                            </div>

                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="cod_oficina">@lang('Office')</label>
                                    <select class="form-select" aria-label="@lang('Office')" id="cod_oficina" name="cod_oficina">
                                        <option>Seleccione ...</option>
                                        @forelse($oficinas as $oficina)
                                            <option value="{{ $oficina->cod_oficina}}" {{ ((old("cod_oficina") ? old("cod_oficina") : $usuario->oficina->cod_oficina) == $oficina->cod_oficina ? "selected":"") }}>{{ $oficina->nom_oficina }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                                
                            </div>
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

                            <!-- Save changes button-->
                            <button type="submit" class="btn btn-primary">@lang('Save changes')</button>
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