<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReferenciasGenerales;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReferenciasGeneralesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // vaciamos la tabla
        ReferenciasGenerales::truncate();

        //importacion de json de datos generales
        $referencias_json = File::get("database/data/ref-generales.json");
        $referencias = json_decode($referencias_json);

        // insercion
        foreach ($referencias as $ref) {
            ReferenciasGenerales::create([
                'dominio'       => $ref->dominio,
                'descripcion'   => $ref->descripcion,
                'val_minimo'    => $ref->val_minimo,
                'val_maximo'    => $ref->val_maximo,
                'codigo'        => $ref->codigo,
                'referencia'    => $ref->referencia,
                'env_correo'    => $ref->env_correo,
                'usu_insercion' => 425,
            ]);
        }
    }
}
