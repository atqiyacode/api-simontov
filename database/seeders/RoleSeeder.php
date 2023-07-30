<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // all access
        $allPermissions = Permission::all()->pluck('id');
        $superadmin = Role::updateOrCreate(['guard_name' => 'api', 'name' => 'superadmin']);
        $superadmin->syncPermissions($allPermissions);

        Role::updateOrCreate(['guard_name' => 'api', 'name' => 'developer']);

        Role::updateOrCreate(['guard_name' => 'api', 'name' => 'demo']);

        Role::updateOrCreate(['guard_name' => 'api', 'name' => 'admin']);

        Role::updateOrCreate(['guard_name' => 'api', 'name' => 'client']);

        Role::updateOrCreate(['guard_name' => 'api', 'name' => 'employee']);
    }
}
