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
            'display_name' => 'Administrator',
            'description' => 'System Administrator',
            'removable' => false
        ]);

        DB::table('roles')->insert([
            'name' => 'client',
            'display_name' => 'Client',
            'description' => 'system Client',
            'removable' => false
        ]);

        DB::table('roles')->insert([
            'name' => 'driver',
            'display_name' => 'Driver',
            'description' => 'system Driver',
            'removable' => false
        ]);

        DB::table('roles')->insert([
            'name' => 'supervisor',
            'display_name' => 'Service Supervisor',
            'description' => 'system Service Supervisor',
            'removable' => false
        ]);

        DB::table('roles')->insert([
            'name' => 'branch-office',
            'display_name' => 'Branch Office',
            'description' => 'system Branch Office',
            'removable' => false
        ]);

        
    }
}
