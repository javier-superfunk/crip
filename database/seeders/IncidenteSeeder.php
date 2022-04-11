<?php

namespace Database\Seeders;

use App\Models\Incidente;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IncidenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Incidente::factory()->count(50)->create();
    }
}
