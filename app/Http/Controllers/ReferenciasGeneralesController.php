<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReferenciasGeneralesRequest;
use App\Http\Requests\UpdateReferenciasGeneralesRequest;
use App\Models\ReferenciasGenerales;

class ReferenciasGeneralesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        $dominios = ReferenciasGenerales::distinct()->get(['dominio']);

        return view('referencias.index', compact('dominios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReferenciasGeneralesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReferenciasGeneralesRequest $request)
    {
        // evaluamos el dominio
        $tip_mensaje = 'success';
        $mensaje = 'Se creó la referencia correctamente.';

        if (!is_null($request->get('dominio-combo')) && $request->get('dominio-combo') != 'nuevo') {
            $dominio = $request->get('dominio-combo');
        } else {
            if (!is_null($request->get('dominio-combo'))) {
                $dominio = $request->get('dominio');
            } else {
                $tip_mensaje = 'error';
                $mensaje = 'El campo DOMINIO es oblibatorio.';
            }
        }

        //
        ReferenciasGenerales::create([
            'dominio' => trim(strtoupper($dominio)),
            'val_minimo' => $request->get('val_minimo'),
            'val_maximo' => $request->get('val_maximo'),
            'descripcion' => $request->get('descripcion'),
            'codigo' => $request->get('codigo'),
            'env_correo' => $request->input('env_correo', 0) ? 1 : 0,
            'referencia' => $request->get('referencia'),
        ]);

        // redirect
        return redirect()->route('referencias.index')->with($tip_mensaje, $mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReferenciasGenerales  $referenciasGenerales
     * @return \Illuminate\Http\Response
     */
    public function show(ReferenciasGenerales $referenciasGenerales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReferenciasGenerales  $referenciasGenerales
     * @return \Illuminate\Http\Response
     */
    public function edit(ReferenciasGenerales $referenciasGenerales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReferenciasGeneralesRequest  $request
     * @param  \App\Models\ReferenciasGenerales  $referenciasGenerales
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReferenciasGeneralesRequest $request, ReferenciasGenerales $referencia)
    {
        //
        //$referencia = ReferenciasGenerales::find($referenciasGenerales);
        $referencia->val_minimo = $request->get('val_minimo');
        $referencia->val_maximo = $request->get('val_maximo');
        $referencia->descripcion = $request->get('descripcion');
        $referencia->codigo = $request->get('codigo');
        $referencia->referencia = $request->get('referencia');
        $referencia->env_correo = $request->input('env_correo', 0) ? 1 : 0;
        $referencia->save();

        // redirect
        return redirect()->route('referencias.index')->with('success', 'La referencia fue modificada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReferenciasGenerales  $referenciasGenerales
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReferenciasGenerales $referencia)
    {
        //
        $referencia->delete();

        // redirect
        return redirect()->route('referencias.index')->with('success', 'La referencia fue eliminada definitivamente del sistema.');
    }
}
