<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'System Administrator',
            'removable' => false
        ]);

        DB::table('roles')->insert([
            'name' => 'client',
            'display_name' => 'Cliente',
            'description' => 'system Client',
            'removable' => false
        ]);

        DB::table('roles')->insert([
            'name' => 'driver',
            'display_name' => 'Conductor',
            'description' => 'system Driver',
            'removable' => false
        ]);

        DB::table('roles')->insert([
            'name' => 'supervisor',
            'display_name' => 'Asesor de servicio',
            'description' => 'system Service Supervisor',
            'removable' => false
        ]);

        DB::table('roles')->insert([
            'name' => 'branch-representative',
            'display_name' => 'Representante de surcursal',
            'description' => 'system Branch Representative',
            'removable' => false
        ]);

        
    }
}
