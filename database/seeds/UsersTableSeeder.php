<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Support\User\UserStatus;

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
        $role = DB::table('roles')->where('name', 'admin')->first();
        DB::table('users')->insert([
            'role_id' => $role->id,
            'name' => 'Maria',
            'lastname' => 'Mendez',
            'email' => 'admin@admin.com',
            'lang' => 'es',
            'password' => bcrypt('secret'),
            'phones' => '{"phone_mobile":"12345678","phone_home":"987654321"}',
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);
        //clientes
        $role = DB::table('roles')->where('name', 'client')->first();
        $client1 = User::create([
            'role_id' => $role->id,
            'name' => 'Juan',
            'lastname' => 'Perez',
            'email' => 'client@client.com',
            'lang' => 'es',
            'phones' => '{"phone_mobile":"12345678","phone_home":"987654321"}',
            'password' => 'secret',
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('clients_settings')->insert([
            'user_id' => $client1->id,
            'locations_labels' => '{"1":"Casa","2":"Oficina"}',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $client2 = User::create([
            'role_id' => $role->id,
            'name' => 'Cristian',
            'lastname' => 'Medina',
            'email' => 'client2@client.com',
            'lang' => 'es',
            'phones' => '{"phone_mobile":"12345678"}',
            'password' => 'secret',
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('clients_settings')->insert([
            'user_id' => $client2->id,
            'locations_labels' => '{"1":"Casa","2":"Oficina"}',
            'created_at' => \Carbon\Carbon::now()
        ]);
        //conductores
        $role = DB::table('roles')->where('name', 'driver')->first();
        DB::table('users')->insert([
            'role_id' => $role->id,
            'name' => 'José',
            'lastname' => 'Lopéz',
            'email' => 'driver@driver.com',
            'lang' => 'es',
            'password' => bcrypt('secret'),
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('users')->insert([
            'role_id' => $role->id,
            'name' => 'Carla',
            'lastname' => 'Marquez',
            'email' => 'driver2@driver.com',
            'lang' => 'es',
            'password' => bcrypt('secret'),
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);
        //asesores de servicios
        $role = DB::table('roles')->where('name', 'supervisor')->first();
        DB::table('users')->insert([
            'role_id' => $role->id,
            'name' => 'Josué',
            'lastname' => 'Parra',
            'email' => 'service@advisor.com',
            'lang' => 'es',
            'password' => bcrypt('secret'),
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('users')->insert([
            'role_id' => $role->id,
            'name' => 'Antony',
            'lastname' => 'Diaz',
            'email' => 'service2@advisor.com',
            'lang' => 'es',
            'password' => bcrypt('secret'),
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);
        //representantes de sucursal
        $role = DB::table('roles')->where('name', 'branch-representative')->first();
        DB::table('users')->insert([
            'role_id' => $role->id,
            'name' => 'Carlos',
            'lastname' => 'Suarez',
            'email' => 'carlos@representative.com',
            'lang' => 'es',
            'password' => bcrypt('secret'),
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('users')->insert([
            'role_id' => $role->id,
            'name' => 'Luis',
            'lastname' => 'Mendez',
            'email' => 'luis@representative.com',
            'lang' => 'es',
            'password' => bcrypt('secret'),
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
