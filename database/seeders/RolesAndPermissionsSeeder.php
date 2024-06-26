<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view:orders',
            'create:orders',
            'edit:orders',
            'delete:orders',

            'view:organizations',
            'create:organizations',
            'edit:organizations',
            'delete:organizations',

            'view:users',
            'create:users',
            'edit:users',
            'delete:users',

            'view:clients',
            'create:clients',
            'edit:clients',
            'delete:clients',

            'view:items',
            'create:items',
            'edit:items',
            'delete:items',
        ];

        $roles = [
            'client_manager' => ['view:clients', 'edit:clients', 'create:clients', 'view:items', 'create:items', 'edit:items'],
            'user_manager' => ['view:users', 'edit:users', 'create:users'],
            'orders_manager' => ['view:orders', 'edit:orders', 'create:orders', 'view:items', 'create:items', 'edit:items'],
            'organization_manager' => ['view:organizations', 'edit:organizations', 'create:organizations'],

            'admin' => $permissions,
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'api']);
        }

        // Create roles and assign existing permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'api']);
            $role->syncPermissions($rolePermissions);
        }
    }
}
