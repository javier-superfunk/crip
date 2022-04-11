@extends('layouts.dashboard')

{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        TITULO --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('titulo') {{ __('Cambio de clave') }}  @endsection

{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        CONTENIDO --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('contenido')
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            @lang('Account Settings') - @lang('Security')
                        </h1>
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
        @if (session('status') == 'two-factor-authentication-enabled')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Autenticación de dos factores ha sido activada.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif
        @if (session('status') == 'two-factor-authentication-disabled')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Autenticación de dos factores ha sido desactivada.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif
        {{-- :::::::::::::::::::::: --}}
        <div class="row">
            <div class="col-lg-6">
                <!-- Change password card-->
                <div class="card mb-4">
                    <div class="card-header">@lang('Change Password')</div>
                    <div class="card-body">
                        <p>Por motivos de seguridad, debe cambiar el pin temporal otorgado, por una contraseña segura que usted pueda recordar.</p>
                        <p>
                            Su nueva contraseña debe cumplir las siguientes características:
                            <ul>
                                <li>Longitud mínima de 8 caracteres.</li>
                                <li>Mayúsculas y minúsculas.</li>
                                <li>Uno o más números.</li>
                            </ul>
                        </p>
                        <form method="POST" action="{{ route('mi-cuenta.cambio-password') }}">
                            
                            @csrf

                            <!-- Form Group (new password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="password">@lang('New Password')</label>
                                <input class="form-control" name="password" id="password" type="password" placeholder="@lang('Enter new password')" />
                            </div>
                            <!-- Form Group (confirm password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="password_confirmation">@lang('Confirm Password')</label>
                                <input class="form-control" name="password_confirmation" id="password_confirmation" type="password" placeholder="@lang('Confirm new password')" />
                            </div>
                            <button class="btn btn-primary" type="submit">@lang('Save')</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img class="mx-auto d-block" src="{{ asset('assets/img/illustrations/super-pass.svg') }}">
            </div>
        </div>
    </div>
</main>
@endsection