<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proveedores;
use Illuminate\Support\Str;
use App\Mail\BienvenidaUsuario;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class AdministracionUsuariosController extends Controller
{
    private $tip_mensaje;
    private $mensaje;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cantidad = User::count();
        $roles = Role::whereNotIn('name', ['informante','proveedor',])->get(); // Role::all()->pluck('name');
        $proveedores = Proveedores::select('id', 'nombre')->where('activo', 1)->get();

        //dd(DB::getQueryLog());

        return view('usuarios.index', compact('cantidad', 'proveedores', 'roles'));
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
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // iniciamos una transaccion para evitar inconsistencias
        DB::beginTransaction();
        
        //
        $clave = Str::random(10);

        //
        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($clave),
            'remember_token' => Str::random(10),
            'fec_cam_password' => null,
            'usu_insercion' => Auth::user()->id,
            'activo' => 1,
        ]);

        // carga la relacion con el proveedor si corresponde
        if ($request->tip_usuario === 'P') {
            $usuario->proveedor()->attach($request->proveedor);
        }

        $usuario->sendEmailVerificationNotification();
        
        // rol de usuario
        $rol = match ($request->tip_usuario) {
            'P' => 'proveedor',
            'I' => array_merge(array('informante'), $request->roles),
        };
        
        $usuario->syncRoles($rol);
        
        
        $usuario->save();
        
        // envío de mail de bienvenida
        Mail::to($usuario)->send(new BienvenidaUsuario($usuario, $clave));
        
        // se confirma la transaccion
        DB::commit();

        // redirect
        return redirect()->route('usuarios.index')
                        ->with('success', "El usuario $usuario->name fue creado correctamente.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        $user = $usuario->proveedor[0]?->id ?? null;
        //var_dump($user->name);
        //dd();
        // Solo si es Admin muestra este rol para asignacion
        if (Auth::user()->hasRole('administrador')) {
            $roles = Role::select('name')->get();
        } else {
            $roles = Role::select('name')->whereNotIn('name', ['administrador',])->get();
        }

        $roles_asignados = $usuario->getRoleNames();

        $proveedores = Proveedores::select('id', 'nombre')->get();

        //
        return view('usuarios.edit', compact('usuario', 'roles', 'roles_asignados', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        // No puede eliminarse a si mismo
        if (!Auth::user()->is($usuario)) {
            /*  // eliminamos la relacion
                if ($usuario->hasRole('proveedor')) {
                    $usuario->proveedor()->detach();
                }
             */
            // seguimo
            $nombre = $usuario->name;
            
            $usuario->delete();
            $usuario->save();
            
            $this->tip_mensaje = 'success';
            $this->mensaje = 'El usuario '.$nombre.' fue eliminado definitivamente del sistema.';
        } else {
            $this->tip_mensaje = 'error';
            $this->mensaje = 'No es posible eliminar su propio usuario.';
        }
        
        // redirect
        return redirect()->route('usuarios.index')->with($this->tip_mensaje, $this->mensaje);
    }

    /**
    * Actualiza el estado del usuario.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function cambiarEstado(User $usuario)
    {
        $estado;
        
        // No puede actualizar su propio estado
        if (!Auth::user()->is($usuario)) {
            if ($usuario->activo) {
                $usuario->activo = false;
                $estado = 'bloqueado';
            } else {
                $usuario->activo = true;
                $estado = 'activado';
            }
            
            $this->tip_mensaje = 'success';
            $this->mensaje = 'El usuario '.$usuario->name.' fue '.$estado.' correctamente';
            
            $usuario->save();
        } else {
            $this->tip_mensaje = 'error';
            $this->mensaje = 'No es posible cambiar el estado de su propio usuario.';
        }

        //
        return redirect()->route('usuarios.index')->with($this->tip_mensaje, $this->mensaje);
    }

    /**
     * Envia formulario de reseteo de password para usuarios ya registrados.
     *
     * @param  User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function resetearPassword(User $usuario)
    {
        //return new BienvenidaUsuario;
        // no solicita verificacion de correo
        $usuario->markEmailAsVerified();
        $usuario->save();
        $token = app('auth.password.broker')->createToken($usuario);
        $usuario->sendPasswordResetNotification($token);
        
        return redirect()->route('usuarios.index')->with('success', 'Se envió un correo con el link para el cambio de contraseña de '.$usuario->name);
    }
}
