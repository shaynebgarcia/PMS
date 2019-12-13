<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$faker = Faker::create();

    	DB::table('users')->insert([
    			'is_employee' => 1,
	            'lastname' => $faker->lastName,
	            'firstname' => $faker->firstName,
	            'middlename' => $faker->lastName,
	            'username' => 'caretaker_1',
	            'email' => $faker->email,
	            'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
	            'password' => bcrypt('pass'),
	            'slug' => $faker->userName,
	            'created_at' => $faker->dateTime($max = 'now'),
            	'updated_at' => $faker->dateTime($max = 'now'),
	    ]);
	    DB::table('users')->insert([
    			'is_employee' => 1,
	            'lastname' => $faker->lastName,
	            'firstname' => $faker->firstName,
	            'middlename' => $faker->lastName,
	            'username' => 'caretaker_2',
	            'email' => $faker->email,
	            'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
	            'password' => bcrypt('pass'),
	            'slug' => $faker->userName,
	            'created_at' => $faker->dateTime($max = 'now'),
            	'updated_at' => $faker->dateTime($max = 'now'),
	    ]);
	    DB::table('users')->insert([
    			'is_employee' => 1,
	            'lastname' => $faker->lastName,
	            'firstname' => $faker->firstName,
	            'middlename' => $faker->lastName,
	            'username' => 'caretaker_3',
	            'email' => $faker->email,
	            'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
	            'password' => bcrypt('pass'),
	            'slug' => $faker->userName,
	            'created_at' => $faker->dateTime($max = 'now'),
            	'updated_at' => $faker->dateTime($max = 'now'),
	    ]);
	    DB::table('users')->insert([
    			'is_employee' => 1,
	            'lastname' => $faker->lastName,
	            'firstname' => $faker->firstName,
	            'middlename' => $faker->lastName,
	            'username' => 'caretaker_4',
	            'email' => $faker->email,
	            'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
	            'password' => bcrypt('pass'),
	            'slug' => $faker->userName,
	            'created_at' => $faker->dateTime($max = 'now'),
            	'updated_at' => $faker->dateTime($max = 'now'),
	    ]);
	    DB::table('users')->insert([
    			'is_employee' => 1,
	            'lastname' => $faker->lastName,
	            'firstname' => $faker->firstName,
	            'middlename' => $faker->lastName,
	            'username' => 'caretaker_5',
	            'email' => $faker->email,
	            'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
	            'password' => bcrypt('pass'),
	            'slug' => $faker->userName,
	            'created_at' => $faker->dateTime($max = 'now'),
            	'updated_at' => $faker->dateTime($max = 'now'),
	    ]);
	    \App\PropertyAccess::create([
          'user_id' => 2,
          'property_id' => 1,
        ]);
        \App\PropertyAccess::create([
          'user_id' => 3,
          'property_id' => 2,
        ]);
        \App\PropertyAccess::create([
          'user_id' => 4,
          'property_id' => 3,
        ]);
        \App\PropertyAccess::create([
          'user_id' => 5,
          'property_id' => 4,
        ]);
        \App\PropertyAccess::create([
          'user_id' => 6,
          'property_id' => 5,
        ]);

	      for ($i = 3; $i < 10; $i++) {
	        DB::table('users')->insert([
	            'lastname' => $faker->lastName,
	            'firstname' => $faker->firstName,
	            'middlename' => $faker->lastName,
	            'username' => $faker->userName,
	            'email' => $faker->email,
	            'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
	            'password' => bcrypt('pass'),
	            'slug' => $faker->userName,
	            // 'slug' => Str::slug($faker->lastName.' '.$faker->firstName.' '.$i, '-'),
	            'created_at' => $faker->dateTime($max = 'now'),
            	'updated_at' => $faker->dateTime($max = 'now'),
	        ]);
	        DB::table('tenants')->insert([
	        	'user_id' => $i,
	        	'contact' => $faker->phoneNumber,
	        	'address' => $faker->address,
	        	'address_tel' => $faker->phoneNumber,
	        	'address2' => $faker->address,
	        	'address2_tel' => $faker->phoneNumber,
	        	'address3' => $faker->address,
	        	'address3_tel' => $faker->phoneNumber,

	        	'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
	        	'birthplace' => $faker->city,
	        	'age' => $faker->numberBetween($min = 20, $max = 40),
	        	'occupation' => $faker->jobTitle,

	        	'emp_name' => $faker->company,
	        	'office_address' => $faker->address,
	        	'office_tel' => $faker->phoneNumber,
	        	'yrs_w_employer' => $faker->numberBetween($min = 1, $max = 10),

	        	'prev_emp_name' => $faker->company,
	        	'prev_emp_address' => $faker->address,

	        	'spouse_name' => $faker->name,
	        	'spouse_occupation' => $faker->jobTitle,
	        	'spouse_emp_name' => $faker->company,
	        	'spouse_emp_address' => $faker->address,
	        	'spouse_emp_tel' => $faker->phoneNumber,

	        	'rel1_name' => $faker->name,
	        	'rel1_occupation' => $faker->jobTitle,
	        	'rel1_emp_name' => $faker->company,
	        	'rel1_emp_address' => $faker->address,
	        	'rel1_emp_tel' => $faker->phoneNumber,

	        	'rel2_name' => $faker->name,
	        	'rel2_occupation' => $faker->jobTitle,
	        	'rel2_emp_name' => $faker->company,
	        	'rel2_emp_address' => $faker->address,
	        	'rel2_emp_tel' => $faker->phoneNumber,

	        	'em_name' => $faker->name,
	        	'em_rel' => $faker->randomElement($array = array ('Mother','Father','Grandmother', 'Grandfather', 'Aunt', 'Uncle')),
	        	'em_contact_home' => $faker->phoneNumber,
	        	'em_contact_work' => $faker->phoneNumber,
	        	'em_contact_phone' => $faker->phoneNumber,
	        	'em_address' => $faker->address,

	        	'college_uni' => $faker->state.' '.$faker->company,
	        	'college_yr' => $faker->year($max = 'now'),
	        	'college_course' => $faker->bs,
	        	'hs_name' => $faker->state.' '.$faker->company,
	        	'hs_yr' => $faker->year($max = 'now'),
	        	'gs_name' => $faker->state.' '.$faker->company,
	        	'gs_yr' => $faker->year($max = 'now'),
	        	'masters' => $faker->optional()->bs,

	        	'bank_name' => $faker->company,
	        	'bank_branch' => $faker->city,
	        	'cc_card' => $faker->creditCardType,
	        	'gov_id' => $faker->randomElement($array = array ('SSS','Drivers License','Passport', 'UMID', 'Voters ID', 'TIN ID')),
	        	'cct_no' => $faker->ean8,
	        	'cct_location' => $faker->streetName,
	        	'cct_date' => $faker->date($format = 'Y-m-d', $max = 'now'),

	        ]);
	      }
    }
}
