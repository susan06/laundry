<?php

use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            'code' => bcrypt(str_random(15)),
            'validity' => '2016-11-30',
            'percentage' => 20,
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
