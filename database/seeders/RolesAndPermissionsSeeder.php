<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Borro las tablas
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        
        // Limpiar el cache
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        Role::create(['name' => 'administrador']);
        Role::create(['name' => 'produccion']);
        Role::create(['name' => 'proveedor']);
        Role::create(['name' => 'informante']);
        Role::create(['name' => 'seguridad']);
    }
}
