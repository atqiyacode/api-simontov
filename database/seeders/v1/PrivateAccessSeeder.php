<?php

namespace Database\Seeders\v1;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PrivateAccessSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $privateAccessApi = Role::where('name', 'privateAccess')->first();
        $superadminRole = Role::where('name', 'superadmin')->first();

        $atqiya = User::where('email', 'atqiya@atqiyacode.com')->firstOrFail();
        $atqiya->username = 'atqiyacode';
        $atqiya->phone = null;
        $atqiya->password = Hash::make('password');
        $atqiya->update();

        $atqiya->syncRoles([$privateAccessApi]);

        $jeksi = User::where('email', 'jeksi@sentralnusa.com')->firstOrFail();
        $jeksi->username = 'jeksi';
        $jeksi->password = Hash::make('Bsdcity2023');
        $jeksi->update();

        $jeksi->syncRoles([$privateAccessApi]);

        $demo = User::where('username', '10000')->firstOrFail();
        $demo->phone = '62895330160610';
        $demo->update();
    }
}
