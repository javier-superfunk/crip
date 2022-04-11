<?php

namespace App\Models;

use App\Traits\AuditoriaModelosTrait;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsuarioInformanteSistema extends Pivot
{
    use HasFactory, AuditoriaModelosTrait;
}
