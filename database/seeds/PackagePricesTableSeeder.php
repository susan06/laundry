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
        for ($i=1; $i <= 4; $i++) {
            DB::table('package_prices')->insert([
                'price' => rand(2,20),
                'package_id' => 1,
                'delivery_schedule' => $i
            ]);
        }

        for ($i=1; $i <= 4; $i++) {
            DB::table('package_prices')->insert([
                'price' => rand(2,20),
                'package_id' => 2,
                'delivery_schedule' => $i
            ]);
        }

        for ($i=1; $i <= 4; $i++) {
            DB::table('package_prices')->insert([
                'price' => rand(2,20),
                'package_id' => 3,
                'delivery_schedule' => $i
            ]);
        }

        for ($i=1; $i <= 4; $i++) {
            DB::table('package_prices')->insert([
                'price' => rand(2,20),
                'package_id' => 4,
                'delivery_schedule' => $i
            ]);
        }

        for ($i=1; $i <= 4; $i++) {
            DB::table('package_prices')->insert([
                'price' => rand(2,20),
                'package_id' => 5,
                'delivery_schedule' => $i
            ]);
        }

    }
}
