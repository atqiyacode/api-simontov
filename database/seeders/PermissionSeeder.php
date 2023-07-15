<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::updateOrCreate(['guard_name' => 'api', 'name' => 'manage-role']);
        Permission::updateOrCreate(['guard_name' => 'api', 'name' => 'manage-permission']);
        Permission::updateOrCreate(['guard_name' => 'api', 'name' => 'manage-user']);

        Permission::updateOrCreate(['guard_name' => 'api', 'name' => 'manage-employee']);

        Permission::updateOrCreate(['guard_name' => 'api', 'name' => 'upload-file']);
        Permission::updateOrCreate(['guard_name' => 'api', 'name' => 'download-file']);

        // special
        Permission::updateOrCreate(['guard_name' => 'api', 'name' => 'can-see-payroll']);
        Permission::updateOrCreate(['guard_name' => 'api', 'name' => 'can-see-sallary']);
    }
}
