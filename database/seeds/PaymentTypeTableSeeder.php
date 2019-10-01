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
	        [ 'name' => 'Reservation Fee'],
	        [ 'name' => 'Partial Payment'],
	        [ 'name' => 'Full Payment'],
	        [ 'name' => 'Utility Deposit'],
	        [ 'name' => 'Security Deposit'],
	        [ 'name' => 'Other'],
      	];

      foreach ($types as $type) {
            \App\PaymentType::create($type);
      }
    }
}
