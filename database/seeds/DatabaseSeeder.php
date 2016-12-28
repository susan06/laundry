<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 $this->call(RolesTableSeeder::class);
         $this->call(PaymentMethodsTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(CouponsTableSeeder::class);
         $this->call(branchOfficeSeeder::class);
         $this->call(LocationsBranchOfficeSeeder::class);
         $this->call(BranchServicesSeeder::class);
         $this->call(FaqsTableSeeder::class);
         $this->call(PackageCategoryTableSeeder::class);
         $this->call(PackageTableSeeder::class);
         $this->call(PackagePricesTableSeeder::class);
         $this->call(ClientCouponSeeder::class);
         $this->call(SuggestionTableSeeder::class);
         $this->call(QualificationTableSeeder::class);
         $this->call(ClientFriendsTableSeeder::class);

    }
}
