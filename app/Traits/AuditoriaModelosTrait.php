<?php

namespace App\Traits;

trait AuditoriaModelosTrait
{
    protected static function bootAuditoriaModelosTrait()
    {
        if (auth()->check()) {
            // trigger de creacion
            static::creating(function ($model) {
                $model->usu_insercion = auth()->id();
            });

            // trigger de modificacion
            static::updating(function ($model) {
                $model->usu_modificacion = auth()->id();
            });

            // trigger de eliminacion
            static::deleting(function ($model) {
                $model->usu_eliminacion = auth()->id();
            });
        }
    }
}
