<?php

use Illuminate\Database\Seeder;

class ClientLocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients_locations')->insert([
        	'client_id' => 2,
        	'lat' => 8.537981,
    		'lng' => -80.782127,
    		'address' => 'panamá',
    		'label' => 1,
         	'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
