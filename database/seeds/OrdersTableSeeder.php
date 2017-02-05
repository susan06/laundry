<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'client_id' => 2,
            'client_location_id' => 1,
            'date_search' => '2017-02-15',
            'time_search' => 1,
            'date_delivery' => '2017-02-17',
            'time_delivery' => 2,
            'special_instructions' => 'con instrucciones especiales',
            'sub_total' => 13,
            'discount' => 0,
            'total' => 13,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('orders')->insert([
            'client_id' => 2,
            'client_location_id' => 1,
            'date_search' => '2017-02-15',
            'time_search' => 2,
            'date_delivery' => '2017-01-17',
            'time_delivery' => 2,
            'special_instructions' => 'con instrucciones especiales',
            'sub_total' => 20,
            'discount' => 0,
            'total' => 20,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('orders')->insert([
            'client_id' => 2,
            'client_location_id' => 1,
            'date_search' => '2017-05-15',
            'time_search' => 3,
            'date_delivery' => '2017-02-17',
            'time_delivery' => 2,
            'special_instructions' => 'con instrucciones especiales',
            'sub_total' => 17,
            'discount' => 0,
            'total' => 17,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('orders_packages')->insert([
            'order_id' => 1,
            'name' => 'Bolsa 15 libras',
            'price' => 13,
            'created_at' => \Carbon\Carbon::now()
        ]);
        
        DB::table('orders_packages')->insert([
            'order_id' => 2,
            'name' => 'Pack Test',
            'price' => 20,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('orders_packages')->insert([
            'order_id' => 3,
            'name' => 'Trajes',
            'price' => 17,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('orders_payments')->insert([
            'order_id' => 1,
            'payment_method_id' => 1,
            'reference' => 12345,
            'amount' => 13,
            'status' => true,
            'confirmed' => true,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('orders_payments')->insert([
            'order_id' => 2,
            'payment_method_id' => 2,
            'reference' => 98765,
            'amount' => 20,
            'status' => true,
            'confirmed' => true,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('orders_payments')->insert([
            'order_id' => 3,
            'payment_method_id' => 2,
            'reference' => 54321,
            'amount' => 17,
            'status' => true,
            'confirmed' => true,
            'created_at' => \Carbon\Carbon::now()
        ]);

    }
}
