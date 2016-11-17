<?php

use Illuminate\Database\Seeder;

class BranchServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ServiceBranchOffice::class, 15)->create();
    }
}
