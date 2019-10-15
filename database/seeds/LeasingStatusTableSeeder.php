<?php

use Illuminate\Database\Seeder;

class LeasingStatusTableSeeder extends Seeder
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
            \App\LeasingAgreementStatus::create($type);
      	}
    }
}
