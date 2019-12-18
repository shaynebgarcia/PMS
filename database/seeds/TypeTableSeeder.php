<?php

use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// OTHER INCOME
		$otherincome_types = [
			[
				'name' => 'Adjustment',
				'amount' => 0,
			],
			[
				'name' => 'Reconnection Fee',
				'amount' => 300,
			],
			[
				'name' => 'Work Order',
				'amount' => 0,
			],
			[
				'name' => 'Other',
				'amount' => 0,
			],
      	];
		foreach ($otherincome_types as $type) {
		    \App\OtherIncomeType::create($type);
		}

      	// PAYMENT
		$payment_types = [
			[ 
				'category' => 'Payment',
				'name' => 'Bill Payment'
			],
			[ 
				'category' => 'Payment',
				'name' => 'Reservation Fee'
			],
			[ 
				'category' => 'Deposit',
				'name' => 'Advance Payment'
			],
			[ 
				'category' => 'Deposit',
				'name' => 'Utility Deposit'
			],
			[ 
				'category' => 'Deposit',
				'name' => 'Security Deposit'
			],
			[ 
				'category' => 'Payment',
				'name' => 'Other Payment'
			],
			[ 
				'category' => 'Deposit',
				'name' => 'Other Deposit'
			],
		];

		foreach ($payment_types as $type) {
			\App\PaymentType::create($type);
		}

		$service_types = [
	        [ 	
	        	'property_id' => 5,
	        	'name' => 'Parking Rental',
	    		'is_subscription' => 1,
	    		'length_month' => 1,
	    		'amount' => 1500,
	    	],
	        [ 	
	        	'property_id' => 5,
	        	'name' => 'Elevator Use',
	    		'is_subscription' => 1,
	    		'length_month' => 1,
	    		'amount' => 1000,
	    	],
      	];

      	foreach ($service_types as $type) {
            \App\ServiceType::create($type);
      	}
    }
}
