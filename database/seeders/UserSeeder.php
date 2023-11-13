<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $supermanRole = Role::where('name', 'superman')->first();
        $superadminRole = Role::where('name', 'superadmin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $demoRole = Role::where('name', 'demo')->first();

        $superadminPermissions = Permission::all();

        $superman = new User();
        $superman->name = 'superman';
        $superman->email = 'superman@simontov.online';
        $superman->username = 'superman';
        $superman->email_verified_at = now();
        $superman->password = Hash::make('password');
        $superman->save();
        $superman->assignRole([$supermanRole]);
        $superman->givePermissionTo($superadminPermissions);

        // superadmin
        $superadmin = new User();
        $superadmin->name = 'superadmin';
        $superadmin->email = 'superadmin@simontov.online';
        $superadmin->username = 'superadmin';
        $superadmin->email_verified_at = now();
        $superadmin->password = Hash::make('password');
        $superadmin->save();
        $superadmin->assignRole([$superadminRole]);

        // admin
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@simontov.online';
        $admin->username = 'admin';
        $admin->email_verified_at = now();
        $admin->password = Hash::make('password');
        $admin->save();
        $admin->assignRole([$adminRole]);

        // demo account
        $demo = new User();
        $demo->name = 'demo account';
        $demo->email = 'demo@simontov.online';
        $demo->username = 'demo-account';
        $demo->email_verified_at = now();
        $demo->password = Hash::make('password');
        $demo->save();
        $demo->assignRole([$demoRole]);
    }
}
