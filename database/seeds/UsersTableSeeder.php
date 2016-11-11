<?php

use Illuminate\Database\Seeder;

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
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);
        //cliente
        $role = DB::table('roles')->where('name', 'client')->first();
        DB::table('users')->insert([
            'role_id' => $role->id,
            'name' => 'Juan',
            'lastname' => 'Perez',
            'email' => 'client@client.com',
            'lang' => 'es',
            'password' => bcrypt('secret'),
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);
        //conductor
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
        //asesor de servicios
        $role = DB::table('roles')->where('name', 'supervisor')->first();
        DB::table('users')->insert([
            'role_id' => $role->id,
            'name' => 'Carlos',
            'lastname' => 'Suarez',
            'email' => 'service@advisor.com',
            'lang' => 'es',
            'password' => bcrypt('secret'),
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);
        //representante de sucursal
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
        //representante de sucursal
        $role = DB::table('roles')->where('name', 'branch-representative')->first();
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
