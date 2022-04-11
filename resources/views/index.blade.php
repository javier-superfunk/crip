@extends('layouts.dashboard')

{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
{{--        TITULO --}}
{{-- :::::::::::::::::::::: --}}
{{-- :::::::::::::::::::::: --}}
@section('titulo') {{ __('Inicio') }}  @endsection

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
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-fluid px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="layout"></i></div>
                            Fluid Layout
                        </h1>
                        <div class="page-header-subtitle">Regardless of screen size, this layout style will keep expanding to take up the whole width of the screen</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="card mt-n10">
            <div class="card-header">Fluid Layout Example</div>
            <div class="card-body">
                This is a second layout option that uses the
                <code>.container-fluid.px-4</code>
                element for the page header and main page content containers. If you expand the width of this page, the content will keep expanding with the screen, regardless of the screen width. On smaller screens, this will look no different than the default boxed layout which uses default
                <code>.container-xl.px-4</code>
                elements.
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