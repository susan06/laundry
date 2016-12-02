<?php

use Illuminate\Database\Seeder;

class ClientCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients_coupons')->insert([
            'client_id' => 2,
            'coupon_id' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('clients_coupons')->insert([
            'client_id' => 2,
            'coupon_id' => 2,
            'created_at' => \Carbon\Carbon::now()
        ]);

    }
}
