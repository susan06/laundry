<?php

use Illuminate\Database\Seeder;

use App\Support\BranchOffice\BranchOfficeStatus;

class branchOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branch_offices')->insert([
            'name' => 'sucursal 1',
            'representative_id' => 8,
            'phone' => '123456789',
            'created_by' => 1,
            'status' => BranchOfficeStatus::SERVICE,
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('branch_offices')->insert([
            'name' => 'sucursal 2',
            'representative_id' => 9,
            'phone' => '987654321',
            'created_by' => 1,
            'status' => BranchOfficeStatus::OUTSERVICE,
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
