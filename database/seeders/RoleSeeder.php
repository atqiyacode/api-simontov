<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Fetch all permissions and store their IDs
        $allPermissionIds = Permission::pluck('id')->all();

        // Prepare the role data
        $roleData = [
            [
                'guard_name' => 'sanctum',
                'name' => 'superman',
                'permission_ids' => $allPermissionIds,
            ],
            [
                'guard_name' => 'sanctum',
                'name' => 'superadmin',
                'permission_ids' => $allPermissionIds,
            ],
            [
                'guard_name' => 'sanctum',
                'name' => 'developer',
                'permission_ids' => [],
            ],
            [
                'guard_name' => 'sanctum',
                'name' => 'demo',
                'permission_ids' => [],
            ],
            [
                'guard_name' => 'sanctum',
                'name' => 'admin',
                'permission_ids' => [],
            ],
            [
                'guard_name' => 'sanctum',
                'name' => 'client',
                'permission_ids' => [],
            ],
        ];

        // Create or update roles along with syncing permissions
        foreach ($roleData as $roleItem) {
            $role = Role::updateOrCreate(
                ['guard_name' => 'sanctum', 'name' => $roleItem['name']]
            );

            // Sync permissions
            $role->syncPermissions($roleItem['permission_ids']);
        }
    }
}
