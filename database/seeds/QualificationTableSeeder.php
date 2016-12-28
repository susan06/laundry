<?php

use Illuminate\Database\Seeder;

class QualificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('qualifications')->insert([
        	'user_id' => 1,
            'quantify' => 5
        ]);

        DB::table('qualifications')->insert([
        	'user_id' => 2,
            'quantify' => 4
        ]);

        DB::table('qualifications')->insert([
        	'user_id' => 3,
            'quantify' => 3
        ]);
    }
}
