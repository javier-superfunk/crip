<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::factory()->count(2)->create()->each(function ($user) {
            $user->assignRole('administrador');
        });
        User::factory()->count(2)->create()->each(function ($user) {
            $user->assignRole('produccion');
        });
        User::factory()->count(2)->create()->each(function ($user) {
            $user->assignRole('seguridad');
        });
        User::factory()->count(5)->create()->each(function ($user) {
            $user->proveedor()->attach(rand(1, 11), ['usu_insercion' => 62]);
            $user->assignRole('proveedor');
        });
        User::factory()->count(5)->unverified()->create()->each(function ($user) {
            $user->proveedor()->attach(rand(1, 11), ['usu_insercion' => 62]);
            $user->assignRole('proveedor');
        });
        User::factory()->count(5)->inactivo()->create()->each(function ($user) {
            $user->proveedor()->attach(rand(1, 11), ['usu_insercion' => 62]);
            $user->assignRole('proveedor');
        });
        User::factory()->count(20)->create()->each(function ($user) {
            $user->assignRole('informante');
        });
        User::factory()->count(10)->inactivo()->create()->each(function ($user) {
            $user->assignRole('informante');
        });
        User::factory()->count(10)->unverified()->create()->each(function ($user) {
            $user->assignRole('informante');
        });
        
        //
        $usuario = User::create([
            'name' => 'Javier Sanchez',
            'email' => 'javier.sanchez@regional.com.py',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'fec_cam_password' => now(),
            'usu_insercion' => 1,
            'activo' => 1,
        ]);
        $usuario->assignRole('administrador');
    }
}
