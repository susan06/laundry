<?php

use Illuminate\Database\Seeder;

class DriverComissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drivers_comission')->insert([
            'user_id' => 4,
            'percentage' => 10,
            'created_at' => \Carbon\Carbon::now()
        ]);

    }
}
