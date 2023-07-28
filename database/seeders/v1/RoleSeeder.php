<?php

namespace Database\Seeders\v1;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // all access
        Role::updateOrCreate(['guard_name' => 'api', 'name' => 'superadmin']);

        Role::updateOrCreate(['guard_name' => 'api', 'name' => 'admin']);

        Role::updateOrCreate(['guard_name' => 'api', 'name' => 'staff']);

        Role::updateOrCreate(['guard_name' => 'api', 'name' => 'demo']);

        Role::updateOrCreate(['guard_name' => 'api', 'name' => 'employee']);

        Role::updateOrCreate(['guard_name' => 'api', 'name' => 'client']);
    }
}
