<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SistemasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'nombre' => Str::title($this->faker->domainWord()),
            'descripcion' => Str::title($this->faker->catchPhrase()),
            'activo' => 1,
            'usu_insercion' => 62,
            'id_proveedor' => rand(1, 11),
        ];
    }

    /**
     * Indica que el modelo tiene estado inactivo.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function inactivo()
    {
        return $this->state(function (array $attributes) {
            return [
                'activo' => 0,
            ];
        });
    }
}
