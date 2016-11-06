<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //administrador
        DB::table('users')->insert([
            'name' => 'Maria',
            'lastname' => 'Mendez',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
        ]);
        //cliente
        DB::table('users')->insert([
            'name' => 'Juan',
            'lastname' => 'Perez',
            'email' => 'client@client.com',
            'password' => bcrypt('secret'),
        ]);
        //conductor
        DB::table('users')->insert([
            'name' => 'José',
            'lastname' => 'Lopéz',
            'email' => 'driver@driver.com',
            'password' => bcrypt('secret'),
        ]);
        //asesor de servicios
        DB::table('users')->insert([
            'name' => 'Carlos',
            'lastname' => 'Suarez',
            'email' => 'service@advisor.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
