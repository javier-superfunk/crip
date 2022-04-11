@extends('layouts.dashboard')

{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        TITULO --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('titulo') {{ __('Confirm password') }}  @endsection

{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        CONTENIDO --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('contenido')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="unlock"></i></div>
                            Verificación de identidad
                        </h1>
                        <div class="page-header-subtitle">Antes de proceder, el sistema necesita confirmar su identidad</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg-9">
                <!-- Default Bootstrap Form Controls-->
                <div id="default">
                    <div class="card mb-4">
                        <div class="card-header">Por favor, ingrese su contraseña</div>
                        <div class="card-body">
                            <!-- Component Preview-->
                            <div class="sbp-preview">
                                <div class="sbp-preview-content">
                                    <form action="/user/confirm-password" method="POST">

                                        @csrf

                                        <div class="mb-3">
                                            <label for="inputPassword">Password</label>
                                            <input class="form-control" id="password" name="password" type="password" placeholder="@lang('Enter current password')" required/>
                                        </div>

                                        <button class="btn btn-primary" type="submit">@lang('Submit')</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection