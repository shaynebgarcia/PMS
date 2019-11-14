<?php

use Illuminate\Database\Seeder;

class UtilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      	$meralcometers = [
	        [ 	'unit_id' => 1,
	    		'type' => 'Electricity',
	    		'no' => '514FAL000426',
	    	],
	    	[ 	'unit_id' => 2,
	    		'type' => 'Electricity',
	    		'no' => '514FAL000840',
	    	],
	    	[ 	'unit_id' => 3,
	    		'type' => 'Electricity',
	    		'no' => '514FAL000836',
	    	],
	    	[ 	'unit_id' => 4,
	    		'type' => 'Electricity',
	    		'no' => '514FAL000822',
	    	],
	    	[ 	'unit_id' => 5,
	    		'type' => 'Electricity',
	    		'no' => '514FAL000837',
	    	],
	    	[ 	'unit_id' => 6,
	    		'type' => 'Electricity',
	    		'no' => '514FAL000826',
	    	],
	    	[ 	'unit_id' => 7,
	    		'type' => 'Electricity',
	    		'no' => '514FAL000846',
	    	],
	    	[ 	'unit_id' => 8,
	    		'type' => 'Electricity',
	    		'no' => '514FAL000831',
	    	],
	    	[ 	'unit_id' => 9,
	    		'type' => 'Electricity',
	    		'no' => '514FAL000830',
	    	],
	    	[ 	'unit_id' => 10,
	    		'type' => 'Electricity',
	    		'no' => '514FAL000821',
	    	],
	    	[ 	'unit_id' => 11,
	    		'type' => 'Electricity',
	    		'no' => '514FAL000800',
	    	],
      	];

      	foreach ($meralcometers as $meralcometer) {
            \App\Utility::create($meralcometer);
      	}

      	$watermeters = [
	        [ 	'unit_id' => 1,
	    		'type' => 'Water',
	    		'no' => '00210-12',
	    	],
	    	[ 	'unit_id' => 2,
	    		'type' => 'Water',
	    		'no' => '00362-12',
	    	],
	    	[ 	'unit_id' => 3,
	    		'type' => 'Water',
	    		'no' => '00885-12',
	    	],
	    	[ 	'unit_id' => 4,
	    		'type' => 'Water',
	    		'no' => '04019-12',
	    	],
	    	[ 	'unit_id' => 5,
	    		'type' => 'Water',
	    		'no' => '04160-12',
	    	],
	    	[ 	'unit_id' => 6,
	    		'type' => 'Water',
	    		'no' => '00185-12',
	    	],
	    	[ 	'unit_id' => 7,
	    		'type' => 'Water',
	    		'no' => '00996-12',
	    	],
	    	[ 	'unit_id' => 8,
	    		'type' => 'Water',
	    		'no' => '00251-12',
	    	],
	    	[ 	'unit_id' => 9,
	    		'type' => 'Water',
	    		'no' => '00089-12',
	    	],
	    	[ 	'unit_id' => 10,
	    		'type' => 'Water',
	    		'no' => '00190-12',
	    	],
	    	[ 	'unit_id' => 11,
	    		'type' => 'Water',
	    		'no' => '00888-12',
	    	],
      	];

      	foreach ($watermeters as $watermeter) {
            \App\Utility::create($watermeter);
      	}

      	// \App\UtilityBill::create(['leasing_agreement_detail_id'=>1,'utility_id' => 1,'to_bill'=>'Oct2019','amount'=>1358.75]); 

      	// \App\UtilityBill::create(['leasing_agreement_detail_id'=>1,'utility_id' => 12,'to_bill'=>'Oct2019','amount'=>550.00]); 
    }
}
