<?php

namespace Database\Seeders\v1;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperadminAccessSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadminRole = Role::where('name', 'superadmin')->first();
        $atqiya = new User();
        $atqiya->name = 'atqiyacode';
        $atqiya->email = 'atqiya@atqiyacode.com';
        $atqiya->username = 'atqiyacode';
        $atqiya->phone = '0895330160610';
        $atqiya->password = Hash::make('password');
        $atqiya->save();
        $atqiya->assignRole([$superadminRole]);


        $adminRole = Role::where('name', 'admin')->first();
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@admin.com';
        $admin->username = 'admin';
        $admin->phone = '';
        $admin->password = Hash::make('password');
        $admin->save();
        $admin->assignRole([$adminRole]);
    }
}
