<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class PrivateAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => 'atqiyacode',
            'phone' => '62895330160610',
            'name' => 'Suherman atqiya',
            'email' => 'atqiya@atqiyacode.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $privateAccessRole = Role::findByName('privateAccess', 'api');
        $user->assignRole([$privateAccessRole]);
    }
}
