<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="{{ env('APP_AUTOR') }}" />
        
        <title>{{ config('app.name', 'CRIP') }} - @yield('titulo')</title>

        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
        
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- LIVEWIRE STYLES --}}
        @livewireStyles
    </head>
    <body class="nav-fixed">
        {{-- TOPBAR --}}
        @include('layouts.topbar')

        <div id="layoutSidenav">
            {{-- MENU --}}
            @include('layouts.menu')

            <div id="layoutSidenav_content">
                {{-- CONTENIDO --}}
                @yield('contenido')

                {{-- FOOTER --}}
                @include('layouts.footer')
                
            </div>
        </div>

        {{-- :::::::::::::::::::::: --}}
        {{-- Modal --}}
        {{-- :::::::::::::::::::::: --}}
        @yield('modal')

        {{-- LIVEWIRE SCRIPTS --}}
        @livewireScripts

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/all.min.js') }}"></script>

        {{-- :::::::::::::::::::::: --}}
        {{-- Javascript --}}
        {{-- :::::::::::::::::::::: --}}
        @yield('js-scripts')
    </body>
</html>