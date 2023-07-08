<?php

namespace App\Models;

use App\Models\User;
use App\Models\Proveedores;
use App\Models\UsuarioInformanteSistema;
use App\Traits\AuditoriaModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sistemas extends Model
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
        'activo',
        'id_proveedor',
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
                                            ->orWhere('descripcion', 'like', '%'.$cadena.'%')
                                            ->orWhereRelation('proveedor', 'nombre', 'like', '%'.$cadena.'%');
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
     * Obtiene el proveedor del sistema
     *
     */
    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class, 'id_proveedor');
    }

    /**
     * The roles that belong to the Sistemas
     *
     */
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuario_informante_sistemas', 'id_sistema', 'id_usuario')
                    ->using(UsuarioInformanteSistema::class)
                    ->withPivot('usu_insercion', 'usu_modificacion', 'usu_eliminacion')
                    ->withTimestamps();
    }

    /**
     * Get all of the comments for the Sistemas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidentes(): HasMany
    {
        return $this->hasMany(Incidente::class, 'id_sistema');
    }
}
