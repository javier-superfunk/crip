<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\SistemasController;
use App\Http\Controllers\IncidentesController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\ReferenciasGeneralesController;
use App\Http\Controllers\AdministracionUsuariosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware(['auth', 'verified', 'must-change-password'])->group(function () {
    
    /*
    |
    |--------------------------------------------------------------------------
    | Página principal
    |--------------------------------------------------------------------------
    |
    */
    Route::view('home', 'index')->name('home');

    /*
    |--------------------------------------------------------------------------
    | Rutas de Usuario
    |--------------------------------------------------------------------------
    |
    | Rutas relacionadas al cambio de constraseña propio de cada usuario
    |
    */
    Route::withoutMiddleware(['must-change-password'])->group(function () {
        Route::get(
            '/mi-cuenta/cambiar-password',
            [UsuarioController::class,'indexCambiarPassword']
        )->name('mi-cuenta.cambiar-password');
        
        Route::post(
            'mi-cuenta/cambiar-password',
            [UsuarioController::class,'cambiarPassword']
        )->name('mi-cuenta.cambio-password');
    });
    
    Route::post(
        '/mi-cuenta/nuevo-password',
        [UsuarioController::class,'nuevoPassword']
    )->name('mi-cuenta.nuevo-password');

    Route::get('mi-cuenta', [UsuarioController::class,'index'])->name('mi-cuenta.index');

    /*
    |--------------------------------------------------------------------------
    | Rutas de Incidentes
    |--------------------------------------------------------------------------
    |
    | Rutas relacionadas al reporte y administracion de los incidentes
    |
    */
    Route::group(['middleware' => ['role:administrador|informante|proveedor']], function () {
        Route::resource('incidentes', IncidentesController::class);
    });
    /*
    |--------------------------------------------------------------------------
    | Rutas de Administración de Usuario
    |--------------------------------------------------------------------------
    |
    | Rutas para administracion de usuarios por parte de Seguridad
    |
    */
    Route::group(['middleware' => ['role:administrador|seguridad']], function () {
        
        // Cambio de estado de usuario
        Route::get(
            '/usuarios/cambiar-estado/{usuario}',
            [AdministracionUsuariosController::class,'cambiarEstado']
        )->name('usuarios.cambiar-estado');

        // Reseteo de contraseña de usuario
        Route::get(
            '/usuarios/restablecer-password/{usuario}',
            [AdministracionUsuariosController::class,'resetearPassword']
        )->name('usuarios.restablecer-password');

        /*
        Route::get(
            '/usuarios/listado-excel',
            [AdministracionUsuariosController::class,'generarExcel']
        )->name('usuarios.excel');
        */
        Route::resource('usuarios', AdministracionUsuariosController::class);
    });
    
    /*
    |--------------------------------------------------------------------------
    | Rutas de Administración de Proveedores
    |--------------------------------------------------------------------------
    |
    | Rutas para administracion de proveedores por parte de Produccion
    |
    */
    Route::group(['middleware' => ['role:administrador|produccion']], function () {
        /*
        // Reseteo de contraseña de usuario
        Route::get(
            '/usuarios/restablecer-password/{usuario}',
            [AdministracionUsuariosController::class,'resetearPassword']
        )->name('usuarios.restablecer-password');


        Route::get(
            '/usuarios/listado-excel',
            [AdministracionUsuariosController::class,'generarExcel']
        )->name('usuarios.excel');
        */
        // Cambio de estado de usuario
        Route::get(
            '/proveedores/cambiar-estado/{proveedor}',
            [ProveedoresController::class,'cambiarEstado']
        )->name('proveedores.cambiar-estado');

        Route::resource(
            'proveedores',
            ProveedoresController::class,
            [ 'parameters' => ['proveedores' => 'proveedor',] ]
        )->except(['create', 'show', 'edit', ]);
        
        // Rutas de Sistemas
        Route::resource('sistemas', SistemasController::class)->except(['create', 'show', 'edit', ]);
        Route::get(
            '/sistemas/cambiar-estado/{sistema}',
            [SistemasController::class,'cambiarEstado']
        )->name('sistemas.cambiar-estado');

        // rutas de referencias generales
        //Route::get('/referencias/listado-excel', [ReferenciasGeneralesController::class,'generarExcel'])->name('referencias.excel');
        Route::resource('referencias', ReferenciasGeneralesController::class)->except(['create', 'show', 'edit',]);
    });
});
