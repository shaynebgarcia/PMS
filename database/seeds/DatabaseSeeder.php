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
        $this->call(TypeTableSeeder::class);
        $this->call(UtilityTableSeeder::class);
        
        $this->call(Faker2TableSeeder::class);
        $this->call(FakerTableSeeder::class);
        
        
        $this->call(InventoryTableSeeder::class);
    }
}
