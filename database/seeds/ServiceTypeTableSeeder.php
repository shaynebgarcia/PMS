<?php

use Illuminate\Database\Seeder;

class ServiceTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$types = [
	        [ 	'name' => 'Parking Rental',
	    		'is_subscription' => 1,
	    		'length_month' => 1,
	    		'monthly_rate' => 1000,
	    		'daily_rate' => 100,
	    	],
	        [ 	'name' => 'Elevator Use',
	    		'is_subscription' => 1,
	    		'length_month' => 1,
	    		'monthly_rate' => 1000,
	    		'daily_rate' => 100,
	    	],
	        [ 	'name' => 'Maintenance',
	    		'is_subscription' => 0,
	    	],
	        [ 	'name' => 'Repair',
	    		'is_subscription' => 0,
	    	],
      	];

      	foreach ($types as $type) {
            \App\ServiceType::create($type);
      	}
    }
}
