<?php

use Illuminate\Database\Seeder;
use App\Property as Property;
use App\Unit as Unit;
use App\UnitType as UnitType;
use App\PropertyAccess as PropertyAccess;
use Faker\Factory as Faker;

class PropertyUnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      for ($i = 1; $i < 5; $i++) {
        DB::table('properties')->insert([
            'code' => strtoupper($faker->unique()->randomLetter),
            'name' => $faker->company,
            'address' => $faker->address,
            'floor_total' => rand(5, 12),
            'unit_total' => rand(20, 60),
            'contact' => $faker->phoneNumber,
            'date_finish' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'date_start_leasing' => $faker->date($format = 'Y-m-d', $max = 'now'),

            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),
        ]);
      }

      DB::table('properties')->insert([
            'name' => 'Southgate Building',
            'code' => 'X',
            'address' => 'Ayala Alabang Muntinlupa City',
            'floor_total' => 6,
            'unit_total' => 18,
            'contact' => $faker->phoneNumber,
            'date_finish' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'date_start_leasing' => $faker->date($format = 'Y-m-d', $max = 'now'),

            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),
        ]);


      $types = [
        [ 'property_id' => 5,
          'name' => 'Studio',
          'size' => '18sqm',
          'lease_price' =>  9580.00],
        [ 'property_id' => 5,
          'name' => 'Loft',
          'size' => '25sqm',
          'lease_price' => 11120.00],
        [ 'property_id' => 5,
          'name' => '2-BR',
          'size' => '30sqm',
          'lease_price' => 13780.00],
        [ 'property_id' => 5,
          'name' => 'Penthouse',
          'size' => '35sqm',
          'lease_price' => 15890.00],
      ];

      foreach ($types as $type) {
            \App\UnitType::create($type);
      }

      for ($i = 1; $i < 18; $i++) {

        $floor_array = array('SW','NW', 'SE', 'NE', 'N', 'S', 'E', 'W');
        $fa = $floor_array[array_rand($floor_array, 1)];

        DB::table('units')->insert([
            'property_id' => 5,
            'unit_type_id' => rand(1, 4),
            'floor_no' => $floor_rand = rand(1, 6),
            'number' => $fa.'-0'.$floor_rand.'-'.$i,

            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now'),
        ]);
      }

      $properties = Property::all();
      foreach ($properties as $property) {
        PropertyAccess::create([
          'user_id' => 1,
          'property_id' => $property->id,
        ]);
      }

    }
}
