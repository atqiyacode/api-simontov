<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SampleUserSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadminRole = Role::where('name', 'superadmin')->first();

        $demoRole = Role::where('name', 'demo')->first();

        $atqiya = new User();
        $atqiya->name = 'suherman atqiya';
        $atqiya->email = 'atqiya@atqiyacode.com';
        $atqiya->phone = '+62895330160610';
        $atqiya->email_verified_at = now();
        $atqiya->password = Hash::make('password');
        $atqiya->save();

        $atqiya->assignRole([$superadminRole]);

        // demo account
        $demo = new User();
        $demo->name = 'demo account';
        $demo->email = 'demo@mail.com';
        $demo->phone = null;
        $atqiya->email_verified_at = now();
        $demo->password = Hash::make('password');
        $demo->save();

        $demo->assignRole([$demoRole]);
    }
}
