<?php

use Illuminate\Database\Seeder;
use App\Property;
use App\Unit;
use Carbon\Carbon;
class SMARTMAIL extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$A_unit = 64;
    	$B_unit = 74;
    	$C_unit = 74;
    	$D_unit = 26;
    	$E_unit = 0;
    	$F_unit = 112;
    	$G_unit = 74;
    	$H_unit = 48;
    	$M_unit = 3;
    	$K_unit = 15;

    	//PROPERTY A
        $A_property = Property::create([
            'code' => 'A',
            'name' => 'Tim Building'
            'address' => 'ADDRESS HERE',
            'floor_total' => 5,
            'unit_total' => $A_unit,
            'contact' => 'CONTACT HERE',
            'date_finish' => Carbon::now(),
            'date_start_leasing' => Carbon::now(),
        ]);
			$A_unit_types = [
				[	'property_id' => $A_property->id,
					'name' => 'Studio',
					'size' => '10.00sqm',
					'lease_price' =>  8500.00
				],
				[	'property_id' => $A_property->id,
					'name' => 'Studio Small',
					'size' => '8.00sqm',
					'lease_price' =>  8000.00
				],
				[	'property_id' => $A_property->id,
					'name' => 'Studio Small PF',
					'size' => '8.00sqm',
					'lease_price' =>  8000.00
				],
				[	'property_id' => $A_property->id,
					'name' => '1-Bedroom PF',
					'size' => '15.00sqm',
					'lease_price' =>  9500.00
				],
				[	'property_id' => $A_property->id,
					'name' => '1-Bedroom Small PF',
					'size' => '10.00sqm',
					'lease_price' =>  9500.00
				],
				[	'property_id' => $A_property->id,
					'name' => '1-Bedroom',
					'size' => '15.00sqm',
					'lease_price' =>  9000.00
				],
				[	'property_id' => $A_property->id,
					'name' => '1-Bedroom Small',
					'size' => '10.00sqm',
					'lease_price' =>  9000.00
				],
			];

			foreach ($A_unit_types as $type) {
				\App\UnitType::create($type);
			}

			$A_unit_array = [];

			for ($i = 0; $i < $A_unit; $i++) {
				'property_id' => $A_property->id,
	            'unit_type_id' => 1,
	            'floor_no' => 1,
	            'number' => 'A-'.
			}

        //PROPERTY B
        Property::create([
            'code' => 'B',
            'name' => 'Macy Mansion'
            'address' => 'ADDRESS HERE',
            'floor_total' => 5,
            'unit_total' => $B_unit,
            'contact' => 'CONTACT HERE',
            'date_finish' => Carbon::now(),
            'date_start_leasing' => Carbon::now(),
        ]);

        //PROPERTY C
        Property::create([
            'code' => 'C',
            'name' => 'Trixie Tower'
            'address' => 'ADDRESS HERE',
            'floor_total' => 5,
            'unit_total' => $C_unit,
            'contact' => 'CONTACT HERE',
            'date_finish' => Carbon::now(),
            'date_start_leasing' => Carbon::now(),
        ]);

        //PROPERTY D
        Property::create([
            'code' => 'D',
            'name' => 'Osmena Manor'
            'address' => 'ADDRESS HERE',
            'floor_total' => 1,
            'unit_total' => $D_unit,
            'contact' => 'CONTACT HERE',
            'date_finish' => Carbon::now(),
            'date_start_leasing' => Carbon::now(),
        ]);

        //PROPERTY F
        Property::create([
            'code' => 'F',
            'name' => 'Roma Plaza'
            'address' => 'ADDRESS HERE',
            'floor_total' => 5,
            'unit_total' => $F_unit,
            'contact' => 'CONTACT HERE',
            'date_finish' => Carbon::now(),
            'date_start_leasing' => Carbon::now(),
        ]);

        //PROPERTY G
        Property::create([
            'code' => 'G',
            'name' => 'Fortdow Place'
            'address' => 'ADDRESS HERE',
            'floor_total' => 5,
            'unit_total' => $G_unit,
            'contact' => 'CONTACT HERE',
            'date_finish' => Carbon::now(),
            'date_start_leasing' => Carbon::now(),
        ]);

        //PROPERTY H
        Property::create([
            'code' => 'H',
            'name' => 'Marilao Plaza'
            'address' => 'ADDRESS HERE',
            'floor_total' => 2,
            'unit_total' => $H_unit,
            'contact' => 'CONTACT HERE',
            'date_finish' => Carbon::now(),
            'date_start_leasing' => Carbon::now(),
        ]);

        //PROPERTY M
        Property::create([
            'code' => 'M',
            'name' => 'Fort View Tower'
            'address' => 'ADDRESS HERE',
            'floor_total' => 1,
            'unit_total' => $M_unit,
            'contact' => 'CONTACT HERE',
            'date_finish' => Carbon::now(),
            'date_start_leasing' => Carbon::now(),
        ]);

        //PROPERTY K
        Property::create([
            'code' => 'K',
            'name' => 'Sanro Apartments'
            'address' => 'ADDRESS HERE',
            'floor_total' => 2,
            'unit_total' => $K_unit,
            'contact' => 'CONTACT HERE',
            'date_finish' => Carbon::now(),
            'date_start_leasing' => Carbon::now(),
        ]);

    }
}
