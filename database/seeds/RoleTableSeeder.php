<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$roles = [
            [ 'title' => 'Administrator'],
            [ 'title' => 'Level 3 Employee'],
            [ 'title' => 'Level 2 Employee'],
            [ 'title' => 'Level 1 Employee'],
            [ 'title' => 'Employee'],
            [ 'title' => 'Supplier'],
            [ 'title' => 'Pre-Tenant'],
            [ 'title' => 'Tenant'],
            [ 'title' => 'Pre-terminated Tenant'],
            [ 'title' => 'Terminated Tenant'],
            [ 'title' => 'Transferee'],
        ];

      foreach ($roles as $role) {
            \App\Role::create($role);
      }
    }
}
