<?php

namespace Database\Seeders;

use App\Models\Sistemas;
use Illuminate\Database\Seeder;

class SistemasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Sistemas::factory()->count(11)->create();
        Sistemas::factory()->inactivo()->count(8)->create();
    }
}
