<?php

namespace App\Models;

use App\Models\ReferenciasGenerales;
use App\Traits\AuditoriaModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Incidente extends Model
{
    use HasFactory, SoftDeletes, AuditoriaModelosTrait;

    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
    protected $fillable = [
        'titulo',
        'descripcion',
        'estado',
        'prioridad',
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
                                            ->orWhere('titulo', 'like', '%'.$cadena.'%')
                                            ->orWhere('descripcion', 'like', '%'.$cadena.'%')
                                            ->orWhereRelation('estado', 'descripcion', 'like', '%'.$cadena.'%')
                                            ->orWhereRelation('prioridad', 'descripcion', 'like', '%'.$cadena.'%');
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

    public function estado()
    {
        return $this->belongsTo(ReferenciasGenerales::class, 'estado', 'val_minimo')
                    ->where('dominio', '=', 'EST_INCIDENTE');
    }
    
    public function prioridad()
    {
        return $this->belongsTo(ReferenciasGenerales::class, 'prioridad', 'val_minimo')
                    ->where('dominio', '=', 'PRIORIDAD_INCIDENTE');
    }
}
