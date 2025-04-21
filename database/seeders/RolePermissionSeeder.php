<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if the Admin role exists, otherwise create it
        $role = Role::firstOrCreate(
            ['name' => 'Admin', 'guard_name' => 'web'],
            ['code' => 'admin']
        );

        // Permissions list
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'profile-index',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',

            'cmscategory-list',
            'cmscategory-create',
            'cmscategory-edit',
            'cmscategory-delete',

            'cmspage-list',
            'cmspage-create',
            'cmspage-edit',
            'cmspage-delete',

            'currency-list',
            'currency-create',
            'currency-edit',
            'currency-delete',

            'file-manager',
            'websetting-edit',
            'user-activity',
            'log-view',

            'product-list',
            'product-create',
            'product-edit',
            'product-delete',

            'brand-list',
            'brand-create',
            'brand-edit',
            'brand-delete',
        ];

        // Create permissions if they don't already exist and assign them to the role
        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate(
                ['name' => $permissionName, 'guard_name' => 'web']
            );

            if (!$role->hasPermissionTo($permission)) {
                $role->givePermissionTo($permission);
            }

            if (!$permission->hasRole($role)) {
                $permission->assignRole($role);
            }
        }
    }
}
