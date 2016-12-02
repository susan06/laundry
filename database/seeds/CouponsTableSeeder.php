<?php

use Illuminate\Database\Seeder;

use App\Support\Coupon\CouponStatus;

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
            'code' => encrypt(str_random(15)),
            'validity' => '2016-12-15',
            'percentage' => '20%',
            'status' => CouponStatus::VALID,
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('coupons')->insert([
            'code' => encrypt(str_random(15)),
            'validity' => '2016-12-20',
            'percentage' => '10%',
            'status' => CouponStatus::USELESS,
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('coupons')->insert([
            'code' => encrypt(str_random(15)),
            'validity' => '2016-12-25',
            'percentage' => '20%',
            'status' => CouponStatus::VALID,
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('coupons')->insert([
            'code' => encrypt(str_random(15)),
            'validity' => '2016-12-30',
            'percentage' => '20%',
            'status' => CouponStatus::USELESS,
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
