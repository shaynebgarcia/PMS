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
	      for ($i = 2; $i < 12; $i++) {
	        DB::table('users')->insert([
	        	'role_id' => 4,
	            'lastname' => $faker->lastName,
	            'firstname' => $faker->firstName,
	            'middlename' => $faker->lastName,
	            'username' => $faker->userName,
	            'email' => $faker->email,
	            'password' => bcrypt('pass'),
	            'slug' => Str::slug($faker->lastName.' '.$faker->firstName.' '.$i, '-'),
	            'created_at' => $faker->dateTime($max = 'now'),
            	'updated_at' => $faker->dateTime($max = 'now'),
	        ]);
	        DB::table('tenants')->insert([
	        	'user_id' => $i,
	        	'contact' => $faker->phoneNumber,
	        	'address' => $faker->address
	        ]);
	      }
    }
}
