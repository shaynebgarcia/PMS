<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(AdminTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(PermissionRolesTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        
        $this->call(PropertyUnitTableSeeder::class);
        $this->call(PaymentTypeTableSeeder::class);
        $this->call(LeasingStatusTableSeeder::class);
        $this->call(ServiceTypeTableSeeder::class);
        $this->call(UtilityTableSeeder::class);
        $this->call(OtherIncomeTypeTableSeeder::class);
        
        $this->call(FakerTableSeeder::class);
        $this->call(Faker2TableSeeder::class);
    }
}
