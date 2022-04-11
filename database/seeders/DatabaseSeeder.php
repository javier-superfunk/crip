<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Desactivo constraints
        Schema::disableForeignKeyConstraints();
        //
        $this->call([
            RolesAndPermissionsSeeder::class,
            UsersSeeder::class,
            ProveedoresSeeder::class,
            SistemasSeeder::class,
            IncidenteSeeder::class,
            ReferenciasGeneralesSeeder::class,
        ]);
        
        // Activo constraints
        Schema::enableForeignKeyConstraints();
    }
}
