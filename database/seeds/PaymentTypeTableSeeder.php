<?php

use Illuminate\Database\Seeder;

class PaymentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		  $types = [
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

      foreach ($types as $type) {
            \App\PaymentType::create($type);
      }
    }
}
