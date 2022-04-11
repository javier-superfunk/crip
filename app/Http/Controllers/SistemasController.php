<?php

namespace App\Http\Controllers;

use App\Models\Sistemas;
use App\Models\Proveedores;
use App\Http\Requests\StoreSistemasRequest;
use App\Http\Requests\UpdateSistemasRequest;

class SistemasController extends Controller
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
        $cantidad = Sistemas::count();
        $proveedores = Proveedores::select('id', 'nombre')->get();

        //
        return view('sistemas.index', compact('cantidad', 'proveedores'));
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
     * @param  \App\Http\Requests\StoreSistemasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSistemasRequest $request)
    {
        //
        Sistemas::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'id_proveedor' => $request->proveedor,
            'activo' => $request->estado,
        ]);

        // redirect
        return redirect()->route('sistemas.index')
                        ->with('success', "El sistema $request->nombre fue creado correctamente.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sistemas  $sistemas
     * @return \Illuminate\Http\Response
     */
    public function show(Sistemas $sistema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sistemas  $sistemas
     * @return \Illuminate\Http\Response
     */
    public function edit(Sistemas $sistema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSistemasRequest  $request
     * @param  \App\Models\Sistemas  $sistemas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSistemasRequest $request, Sistemas $sistema)
    {
        //
        $sistema->nombre = $request->nombre;
        $sistema->id_proveedor = $request->proveedor;
        $sistema->descripcion = $request->descripcion;
        $sistema->activo = $request->estado;
        $sistema->save();

        // redirect
        return redirect()->route('sistemas.index')
                        ->with('success', "El sistema $sistema->nombre fue actualizado correctamente.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sistemas  $sistemas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sistemas $sistema)
    {
        $nombre = $sistema->name;
        //
        $sistema->delete();

        // redirect
        return redirect()->route('sistemas.index')
                        ->with('success', "El sistema $nombre fue eliminado correctamente.");
    }

    /**
    * Actualiza el estado del proveedor.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function cambiarEstado(Sistemas $sistema)
    {
        $estado;
        
        //
        if ($sistema->activo) {
            $sistema->activo = false;
            $estado = 'bloqueado';
        } else {
            $sistema->activo = true;
            $estado = 'activado';
        }

        $sistema->save();

        //
        return redirect()->route('sistemas.index')
                        ->with("success", "El sistema $sistema->nombre fue $estado correctamente.");
    }
}
