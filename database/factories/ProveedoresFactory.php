<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedoresFactory extends Factory
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
            'nombre' => $this->faker->company(),
            'descripcion' => $this->faker->bs(),
            'email' => $this->faker->unique()->safeEmail(),
            'activo' => 1,
            'usu_insercion' => 62,
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
