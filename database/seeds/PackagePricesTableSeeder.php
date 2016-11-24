<?php

use Illuminate\Database\Seeder;

class PackagePricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('package_prices')->insert([
            'price' => 10,
            'package_id' => 1,
            'delivery_schedule' => 1
        ]);

        DB::table('package_prices')->insert([
            'price' => 10,
            'package_id' => 2,
            'delivery_schedule' => 2
        ]);

        DB::table('package_prices')->insert([
            'price' => 15,
            'package_id' => 3,
            'delivery_schedule' => 3
        ]);

        DB::table('package_prices')->insert([
            'price' => 12,
            'package_id' => 4,
            'delivery_schedule' => 4
        ]);

        DB::table('package_prices')->insert([
            'price' => 14,
            'package_id' => 5,
            'delivery_schedule' => 5
        ]);

    }
}
