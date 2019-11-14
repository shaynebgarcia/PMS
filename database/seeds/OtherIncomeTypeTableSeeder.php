<?php

use Illuminate\Database\Seeder;

class OtherIncomeTypeTableSeeder extends Seeder
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
				'name' => 'Reconnection Fee',
				'amount' => 300,
			],
			[
				'name' => 'Job Order Fee',
				'amount' => 0,
			],
			[
				'name' => 'Maintenance Fee',
				'amount' => 0,
			],
      	];

      foreach ($types as $type) {
            \App\OtherIncomeType::create($type);
      }
    }
}
