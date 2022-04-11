@extends('layouts.dashboard')

{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        TITULO --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('titulo') {{ __('Account') }}  @endsection

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
        <!-- Account page navigation-->
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-lg-6">
                <!-- Change password card-->
                <div class="card mb-4">
                    <div class="card-header">@lang('Change Password')</div>
                    <div class="card-body">
                        <p>
                            Su nueva contraseña debe cumplir las siguientes características:
                            <ul>
                                <li>Longitud mínima de 8 caracteres.</li>
                                <li>Mayúsculas y minúsculas.</li>
                                <li>Uno o más números.</li>
                            </ul>
                        </p>
                        <form method="POST" action="{{ route('mi-cuenta.nuevo-password') }}">
                            
                            @csrf

                            <!-- Form Group (current password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="current_password">@lang('Current Password')</label>
                                <input class="form-control" name="current_password" id="current_password" type="password" placeholder="@lang('Enter current password')" />
                            </div>
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
                <!-- Two factor authentication card-->
                <div class="card mb-4">
                    <div class="card-header">@lang('Two Factor Authentication')</div>
                    <div class="card-body">
                        <p>@lang('Add another level of security to your account by enabling two-factor authentication.') </p>
                        <p>@lang('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.')</p>
                        
                        
                            @if (auth()->user()->two_factor_secret)
                                
                                <div class="mb-3">
                                    {!! auth()->user()->twoFactorQrCodeSvg() !!} 
                                </div>
                                <div class="mb-3">
                                    <p>Guarde estos códigos de recuperacion en un lugar seguro, éstos códigos pueden utilizarse para ingresar al sistema en caso de no tener la aplicación Google Authenticator.</p>
                                    <ul>
                                        @foreach (auth()->user()->recoveryCodes() as $code)
                                            <li>{{$code}}</li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="mb-3">
                                    <div class="row row-cols-auto">
                                        <div class="col">    
                                            <form action="/user/two-factor-recovery-codes" method="POST">
                                                @csrf
                                                <button class="btn btn-light" type="submit">Regenerar claves de recuperación</button>
                                            </form>
                                        </div>
                                        <div class="col">
                                            <form action="/user/two-factor-authentication" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Desactivar 2FA</button>
                                            </form>
                                        </div>                                        
                                    </div>
                                </div>
                                
                            @else
                            <form action="/user/two-factor-authentication" method="POST">
                                @csrf
                                <button class="btn btn-success" type="submit">Activar 2FA</button>
                            </form>    
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection