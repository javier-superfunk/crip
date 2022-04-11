<?php

namespace App\Models;

use App\Models\User;
use App\Models\Sistemas;
use App\Models\UsuarioProveedor;
use App\Traits\AuditoriaModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proveedores extends Model
{
    use HasFactory, SoftDeletes, AuditoriaModelosTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'email',
        'activo',
        'usu_insercion',
        'usu_modificacion',
        'usu_eliminacion',
    ];

    /**
     * Implementacion de busqueda
     *
     * String $cadena
     */
    public static function buscar(String $cadena)
    {
        return empty($cadena) ? static::query()
                            : static::query()->where('id', 'like', '%'.$cadena.'%')
                                            ->orWhere('nombre', 'like', '%'.$cadena.'%')
                                            ->orWhere('email', 'like', '%'.$cadena.'%')
                                            ->orWhere('descripcion', 'like', '%'.$cadena.'%');
        ;
    }

    /**
     *
     * RELACIONES
     *
    */
    public function usuarioInsercion()
    {
        return $this->belongsTo(User::class, 'usu_insercion');
    }

    public function usuarioModificacion()
    {
        return $this->belongsTo(User::class, 'usu_modificacion');
    }

    public function usuarioEliminacion()
    {
        return $this->belongsTo(User::class, 'usu_eliminacion');
    }

    /**
     * Obtiene todos los sistemas del proveedor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sistemas()
    {
        return $this->hasMany(Sistemas::class, 'id_proveedor');
    }

    /**
     * Usuario ligado al proveedor
     *
     */
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuario_proveedor', 'id_proveedor', 'id_usuario')
                    ->using(UsuarioProveedor::class)
                    ->withPivot('usu_insercion', 'usu_modificacion', 'usu_eliminacion')
                    ->withTimestamps();
    }
}
