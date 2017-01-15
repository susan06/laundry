<?php

use Illuminate\Database\Seeder;

class DriverSheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drivers_shedule')->insert([
            'user_id' => 4,
            'value' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('drivers_shedule')->insert([
            'user_id' => 4,
            'value' => 2,
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
