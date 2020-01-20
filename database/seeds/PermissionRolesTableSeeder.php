<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\User;
use Carbon\Carbon;

class PermissionRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        $now = Carbon::now();

        $permissions = [
            // User
            ['name' => 'List User'],
            ['name' => 'Create User'],
            ['name' => 'Update User'],
            ['name' => 'Delete User'],
            ['name' => 'Update User Credentials'],
            ['name' => 'Update User Roles'],

            // Tenant
            ['name' => 'List Tenant'],
            ['name' => 'Create Tenant'],
            ['name' => 'Update Tenant'],
            ['name' => 'Delete Tenant'],

            // Property
            ['name' => 'List Property'],
            ['name' => 'Create Property'],
            ['name' => 'Update Property'],
            ['name' => 'Delete Property'],

            // Unit
            ['name' => 'List Unit'],
            ['name' => 'Create Unit'],
            ['name' => 'Update Unit'],
            ['name' => 'Delete Unit'],

            // Unit
            ['name' => 'List Unit Type'],
            ['name' => 'Create Unit Type'],
            ['name' => 'Update Unit Type'],
            ['name' => 'Delete Unit Type'],

            // Payment
            ['name' => 'List Payment'],
            ['name' => 'Create Payment'],
            ['name' => 'Update Payment'],
            ['name' => 'Delete Payment'],

            // Leasing Agreements
            ['name' => 'List Leasing Agreements'],
            ['name' => 'Create Leasing Agreements'],
            ['name' => 'Update Leasing Agreements'],
            ['name' => 'Delete Leasing Agreements'],

            // Utility
            ['name' => 'List Utility'],
            ['name' => 'Create Utility'],
            ['name' => 'Update Utility'],
            ['name' => 'Delete Utility'],

            // Utility
            ['name' => 'List Utility Bill'],
            ['name' => 'Create Utility Bill'],
            ['name' => 'Update Utility Bill'],
            ['name' => 'Delete Utility Bill'],

            // Order
            ['name' => 'List Orders'],
            ['name' => 'Create Orders'],
            ['name' => 'Update Orders'],
            ['name' => 'Delete Orders'],

            // Service
            ['name' => 'List Service'],
            ['name' => 'Create Service'],
            ['name' => 'Update Service'],
            ['name' => 'Delete Service'],

            // Service
            ['name' => 'List Service Type'],
            ['name' => 'Create Service Type'],
            ['name' => 'Update Service Type'],
            ['name' => 'Delete Service Type'],
        ];

        foreach ($permissions as $key => $permission) {
            $permissions[$key]['guard_name'] = 'web';
            $permissions[$key]['created_at'] = $now;
            $permissions[$key]['updated_at'] = $now;
        }

        Permission::insert($permissions);

        $roles_array = [
            'Super Admin', 'Admin LV1', 'Admin LV2', 'Care Taker', 'Pre-tenant', 'Tenant',
        ];

            foreach($roles_array as $role) {
                $role = Role::firstOrCreate(['name' => trim($role)]);

                if( $role->name == 'Super Admin' ) {
                    // assign all permissions
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Super Admin granted all the permissions');
                } elseif ( $role->name == 'Admin LV1' ) {
                    // assign all permissions
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Admin LV1 granted all the permissions');
                } elseif ( $role->name == 'Admin LV2' ) {
                    // assign all permissions
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Admin LV2 granted all the permissions');
                } elseif ( $role->name == 'Care Taker' ) {
                    $role->syncPermissions(['List Property', 'List Tenant', 'List Payment',]);
                    $this->command->info('Care Taker granted listing only permission');
                } else {
                    // for others by default only read access
                    $role->syncPermissions(['List Property', 'List Tenant', 'List Payment',]);
                }
            }

        $adminuser = User::all()->first();
        $adminuser->assignRole('Super Admin');

        $caretaker = User::whereIn('username', ['caretaker_1', 'caretaker_2', 'caretaker_3', 'caretaker_4', 'caretaker_5'])->get();
        foreach ($caretaker as $ct) {
            $ct->assignRole('Care Taker');
        }

        $tenants = User::whereNotIn('username', ['admin', 'caretaker_1', 'caretaker_2', 'caretaker_3', 'caretaker_4', 'caretaker_5'])->get();
        foreach ($tenants as $tenant) {
            $tenant->assignRole('Pre-tenant');
        }
    }
}
