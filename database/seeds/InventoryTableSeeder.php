<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();

    	DB::table('inventories')->insert([
	            'property_id' => null,
	            'inventory_no' => null,
	            'is_service' => 1,
	            'description' => 'Labor Fee',
	            'qty' => 0,
	            'price' => 0,
	            'created_at' => $faker->dateTime($max = 'now'),
            	'updated_at' => $faker->dateTime($max = 'now'),
	    ]);

	      for ($i = 3; $i < 10; $i++) {
	        DB::table('inventories')->insert([
	            'property_id' => 5,
	            'inventory_no' => 'ITM-'.$i,
	            'description' => 'Item #'.$i,
	            'qty' => rand(0, 50),
	            'price' => rand(20, 2000),
	            'created_at' => $faker->dateTime($max = 'now'),
            	'updated_at' => $faker->dateTime($max = 'now'),
	        ]);
    	}
    }
}
