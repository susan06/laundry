<?php

use Illuminate\Database\Seeder;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            'name' => 'Depósito bancario'
        ]);

        DB::table('payment_methods')->insert([
            'name' => 'Transferencia bancaria'
        ]);
    }
}
