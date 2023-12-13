<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // manage role and permission
        Permission::updateOrCreate(['name' => 'manage-role', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'manage-permission', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'manage-user', 'guard_name' => 'api']);

        // upload download
        Permission::updateOrCreate(['name' => 'upload-file', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'download-file', 'guard_name' => 'api']);

        // role
        Permission::updateOrCreate(['name' => 'show-list-role', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'show-detail-role', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'create-role', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'update-role', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'delete-role', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'restore-role', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'force-delete-role', 'guard_name' => 'api']);

        // permission
        Permission::updateOrCreate(['name' => 'show-list-permission', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'show-detail-permission', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'create-permission', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'update-permission', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'delete-permission', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'restore-permission', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'force-delete-permission', 'guard_name' => 'api']);

        // verification-code-type
        Permission::updateOrCreate(['name' => 'show-list-verification-code-type', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'show-detail-verification-code-type', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'create-verification-code-type', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'update-verification-code-type', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'delete-verification-code-type', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'restore-verification-code-type', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'force-delete-verification-code-type', 'guard_name' => 'api']);

        // verification-code-type
        Permission::updateOrCreate(['name' => 'show-list-user-verification-code', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'show-detail-user-verification-code', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'create-user-verification-code', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'update-user-verification-code', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'delete-user-verification-code', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'restore-user-verification-code', 'guard_name' => 'api']);
        Permission::updateOrCreate(['name' => 'force-delete-user-verification-code', 'guard_name' => 'api']);
    }
}
