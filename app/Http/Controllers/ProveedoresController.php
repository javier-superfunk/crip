<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProveedoresRequest;
use App\Http\Requests\UpdateProveedoresRequest;
use App\Models\Proveedores;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cantidad = Proveedores::count();

        //
        return view('proveedores.index', compact('cantidad'));
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
     * @param  \App\Http\Requests\StoreProveedoresRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProveedoresRequest $request)
    {
        //
        Proveedores::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'email' => $request->email,
            'activo' => $request->estado,
        ]);

        // redirect
        return redirect()->route('proveedores.index')
                        ->with('success', "El proveedor $request->nombre fue creado correctamente.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedores  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedores $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedores  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedores $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProveedoresRequest  $request
     * @param  \App\Models\Proveedores  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProveedoresRequest $request, Proveedores $proveedor)
    {
        //
        $proveedor->nombre = $request->nombre;
        $proveedor->email = $request->email;
        $proveedor->descripcion = $request->descripcion;
        $proveedor->activo = $request->estado;
        $proveedor->save();

        // redirect
        return redirect()->route('proveedores.index')
                        ->with('success', "El proveedor $proveedor->nombre fue actualizado correctamente.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedores  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedores $proveedor)
    {
        $nombre = $proveedor->name;
        //
        $proveedor->delete();

        // redirect
        return redirect()->route('proveedores.index')
                        ->with('success', "El proveedor $nombre fue eliminado correctamente.");
    }

    /**
    * Actualiza el estado del proveedor.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function cambiarEstado(Proveedores $proveedor)
    {
        $estado;
        
        //
        if ($proveedor->activo) {
            $proveedor->activo = false;
            $estado = 'bloqueado';
        } else {
            $proveedor->activo = true;
            $estado = 'activado';
        }

        $proveedor->save();

        //
        return redirect()->route('proveedores.index')
                        ->with("success", "El proveedor $proveedor->nombre fue $estado correctamente.");
    }
}
