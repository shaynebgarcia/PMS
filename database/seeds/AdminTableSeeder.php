<?php

use Illuminate\Database\Seeder;
use App\User;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
        'is_employee' => 1,
    		'lastname' => 'Support',
    		'firstname' => 'Bitverse',
    		'middlename' => 'Admin',
    		'username' => 'admin',
    		'email' => 'itsupport@bitversecorp.com',
        'birthdate' => '1997-10-30',
    		'password' => bcrypt('pass'),
    		'remember_token' => Str::random(60),
        'slug' => 'admin',
        'created_at' => Carbon\Carbon::now(),
        'updated_at' => Carbon\Carbon::now(),
    	]);

    // use Faker\Factory as Faker;
      // $faker = Faker::create();
      // foreach (range(1,5) as $index) {
      //   DB::table('posts')->insert([
      //       'title' => $faker->catchPhrase,
      //       'content' => $faker->paragraph,
      //       'created_at' => $faker->dateTime($max = 'now'),
      //       'updated_at' => $faker->dateTime($max = 'now'),
      //   ]);
      // }
    }
}
