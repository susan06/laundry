<?php

use App\Package;
use Illuminate\Database\Seeder;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(Package::class)->create([
            'name' => 'Pack Test',
            'package_category_id' => 1,
        ]);

    	factory(Package::class)->create([
            'name' => 'Bolsa 10 libras',
            'package_category_id' => 2,
        ]);

    	factory(Package::class)->create([
            'name' => 'Bolsa 15 libras',
            'package_category_id' => 2,
        ]);

    	factory(Package::class)->create([
            'name' => 'Trajes',
            'package_category_id' => 3,
        ]);

    	factory(Package::class)->create([
            'name' => 'Edredones',
            'package_category_id' => 4,
        ]);

    }
}
