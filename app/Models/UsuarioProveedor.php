<?php

namespace App\Models;

use App\Traits\AuditoriaModelosTrait;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsuarioProveedor extends Pivot
{
    use HasFactory, AuditoriaModelosTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuario_proveedor';
}
