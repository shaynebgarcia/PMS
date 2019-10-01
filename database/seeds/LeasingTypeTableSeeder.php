<?php

use Illuminate\Database\Seeder;

class LeasingTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		 $types = [
	        [ 'name' => 'Active'],
	        [ 'name' => 'Pre-terminated'],
	        [ 'name' => 'Terminated'],
      	];

      	foreach ($types as $type) {
            \App\LeasingAgreementType::create($type);
      	}
    }
}
