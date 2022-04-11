<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\VerificarPasswordNuevo;
use App\Rules\VerificarPasswordActual;
use Illuminate\Validation\Rules\Password;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('mi-cuenta.index');
    }

    /**
     * Actualiza su contraseña.
     *
     * @param \Illuminate\Http\Request $request Input del formulario
     *
     * @return \Illuminate\Http\Response
     */
    public function nuevoPassword(Request  $request)
    {
        $request->validate(
            [
            'current_password' => ['required', new VerificarPasswordActual],
            'password' => ['required', new VerificarPasswordNuevo, Password::min(8)->mixedCase()->numbers()],
            'password_confirmation' => ['same:password'],
            ]
        );

        $usuario = Auth::user();
        $usuario->password =  Hash::make($request['password']);
        $usuario->save();

        // vuelta a la vista
        return redirect()->route('mi-cuenta.index')->with('success', 'La contraseña fue actualizada correctamente.');
    }
    
    /**
     * Despliega pantalla de cambio de password obligatorio.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCambiarPassword()
    {
        //
        return view('mi-cuenta.cambiar-password');
    }

    /**
     * Crea una nueva contraseña para el usuario.
     *
     * @param \Illuminate\Http\Request $request Input del formulario
     *
     * @return \Illuminate\Http\Response
     */
    public function cambiarPassword(Request  $request)
    {
        $request->validate(
            [
            'password' => ['required', new VerificarPasswordNuevo, Password::min(8)->mixedCase()->numbers()],
            'password_confirmation' => ['same:password'],
            ]
        );

        $usuario = Auth::user();
        $usuario->password =  Hash::make($request['password']);
        $usuario->fec_cam_password = Carbon::now();
        $usuario->save();

        // vuelta a la vista
        return redirect()->route('mi-cuenta.index')->with('success', 'La contraseña fue actualizada correctamente.');
    }
}
