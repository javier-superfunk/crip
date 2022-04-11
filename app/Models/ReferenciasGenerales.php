<?php

namespace App\Models;

use App\Models\ReferenciasGenerales;
use App\Traits\AuditoriaModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReferenciasGenerales extends Model
{
    use HasFactory, SoftDeletes, AuditoriaModelosTrait;

    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
    protected $fillable = [
        'dominio',
        'val_minimo',
        'val_maximo',
        'descripcion',
        'codigo',
        'referencia',
        'env_correo',
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
                                            ->orWhere('dominio', 'like', '%'.$cadena.'%')
                                            ->orWhere('val_minimo', 'like', '%'.$cadena.'%')
                                            ->orWhere('val_maximo', 'like', '%'.$cadena.'%')
                                            ->orWhere('codigo', 'like', '%'.$cadena.'%')
                                            ->orWhere('referencia', 'like', '%'.$cadena.'%')
                                            ->orWhere('descripcion', 'like', '%'.$cadena.'%');
        ;
    }

    /**
     * Funciones de retorno de datos.
     *
     * @var array
     */
    public static function obtenerDatosDominio(String $dominio) : Builder
    {
        return static::query()->select('id', 'descripcion', 'val_minimo', 'val_maximo', 'referencia', 'codigo', 'env_correo')
                            ->where('dominio', '=', $dominio)->get();
    }
    
    // retorna un dato específico
    // puede retornar mas de un valor
    public static function obtenerDato(String $dominio, String $campo, String $donde, String $seaIgualA) : String
    {
        return static::query()
                    ->where('dominio', $dominio)
                    ->where($donde, $seaIgualA)
                    ->value($campo);
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
}
