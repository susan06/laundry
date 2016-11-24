<?php

use Illuminate\Database\Seeder;

class PackageCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('package_categories')->insert([
            'name' => 'Ofertas',
            'status' => true,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('package_categories')->insert([
            'name' => 'Lavandería',
            'status' => true,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('package_categories')->insert([
            'name' => 'Tintorería',
            'status' => true,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('package_categories')->insert([
            'name' => 'Otros',
            'status' => true,
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
