<?php

use Illuminate\Database\Seeder;
use App\User as User;
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
        'role_id' => 1,
    		'lastname' => 'Support',
    		'firstname' => 'Bitverse',
    		'middlename' => 'Admin',
    		'username' => 'admin',
    		'email' => 'itsupport@bitversecorp.com',
    		'password' => bcrypt('pass'),
    		'remember_token' => Str::random(60),
        'slug' => Str::slug('Support Bitverse 1', '-'),
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
