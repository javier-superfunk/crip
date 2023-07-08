<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incidente>
 */
class IncidenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'titulo' => $this->faker->catchPhrase(),
            'descripcion' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'prioridad' => rand(0, 3),
            'estado' =>  rand(0, 5),
            'usu_insercion' => 62,
            'id_sistema' => rand(1, 19),
        ];
    }

    /**
     * Estados
     * 0 -> Cerrado
     * 1 -> Cargado
     * 2 -> En Espera
     * 3 -> Resuelto
     * 4 -> En Verificacion
     * 5 - Cancelado
    */

    /**
     * Prioridad
     * 0 -> Bajo
     * 1 -> Normal
     * 2 -> Urgente
     */
}
