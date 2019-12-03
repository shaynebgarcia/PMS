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

        ];

        foreach ($permissions as $key => $permission) {
            $permissions[$key]['guard_name'] = 'web';
            $permissions[$key]['created_at'] = $now;
            $permissions[$key]['updated_at'] = $now;
        }

        Permission::insert($permissions);

        $roles_array = [
            'Admin', 'Owner', 'Manager', 'Care Taker', 'Pre-tenant', 'Tenant',
        ];

            foreach($roles_array as $role) {
                $role = Role::firstOrCreate(['name' => trim($role)]);

                if( $role->name == 'Admin' ) {
                    // assign all permissions
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Admin granted all the permissions');
                } elseif ( $role->name == 'Owner' ) {
                    // assign all permissions
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Owner granted all the permissions');
                } elseif ( $role->name == 'Manager' ) {
                    // assign all permissions
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Manager granted all the permissions');
                } elseif ( $role->name == 'Care Taker' ) {
                    $role->syncPermissions(['List Property', 'List Tenant', 'List Payment',]);
                    $this->command->info('Care Taker granted listing only permission');
                } else {
                    // for others by default only read access
                    $role->syncPermissions(['List Property', 'List Tenant', 'List Payment',]);
                }
            }

        $adminuser = User::all()->first();
        $adminuser->assignRole('Admin');

        $caretaker = User::where('username', 'employee_1')->first();
        $caretaker->assignRole('Care Taker');

        $tenants = User::whereNotIn('username', ['admin', 'employee_1'])->get();
        foreach ($tenants as $tenant) {
            $tenant->assignRole('Pre-tenant');
        }
    }
}
