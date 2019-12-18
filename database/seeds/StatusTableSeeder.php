<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//UNIT
		$unit_status = [
	        [	
	        	'model' => 'Unit',
	        	'title' => 'Vacant' //1
	        ],
	        [	
	        	'model' => 'Unit',
	        	'title' => 'Occupied' //2
	        ],
      	];
      	foreach ($unit_status as $status) {
            \App\Status::create($status);
      	}

    	// LEASING AGREEMENT
		$leasing_status = [
	        [	
	        	'model' => 'Leasing Agreement',
	        	'title' => 'Active' //3
	        ],
	        [	
	        	'model' => 'Leasing Agreement',
	        	'title' => 'Pre-terminated' //4
	        ],
	        [	
	        	'model' => 'Leasing Agreement',
	        	'title' => 'Terminated' //5
	        ],
      	];
      	foreach ($leasing_status as $status) {
            \App\Status::create($status);
      	}

    	// LEASING AGREEMENT DETAILS
		$leasing_details_status = [
	        [	
	        	'model' => 'Leasing Agreement Details',
	        	'title' => 'Active' //6
	        ],
	        [	
	        	'model' => 'Leasing Agreement Details',
	        	'title' => 'Expired' //7
	        ],
      	];
      	foreach ($leasing_details_status as $status) {
            \App\Status::create($status);
      	}

    	// JOB ORDER
		$order_status = [
	        [	
	        	'model' => 'Job Order',
	        	'title' => 'Pending' //8
	        ],
	        [	
	        	'model' => 'Job Order',
	        	'title' => 'Processing' //9
	        ],
	        [	
	        	'model' => 'Job Order',
	        	'title' => 'Completed' //10
	        ],
      	];
      	foreach ($order_status as $status) {
            \App\Status::create($status);
      	}
    }
}
