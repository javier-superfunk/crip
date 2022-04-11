<?php

namespace Database\Seeders;

use App\Models\Proveedores;
use Illuminate\Database\Seeder;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Proveedores::factory()->count(6)->create();
        Proveedores::factory()->inactivo()->count(5)->create();
    }
}
