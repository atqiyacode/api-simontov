<?php

namespace Database\Seeders\v1;

use App\Models\v1\AuthVerificationMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AuthVerificationMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AuthVerificationMethod::updateOrCreate([
            'slug' => Str::slug('whatsapp'),
            'name' => 'Whatsapp',
            'status' => 0,
        ]);
        AuthVerificationMethod::updateOrCreate([
            'slug' => Str::slug('email'),
            'name' => 'Email',
            'status' => 1,
        ]);
        AuthVerificationMethod::updateOrCreate([
            'slug' => Str::slug('device'),
            'name' => 'Device',
            'status' => 1,
        ]);
        AuthVerificationMethod::updateOrCreate([
            'slug' => Str::slug('Pin'),
            'name' => 'Pin',
            'status' => 0,
        ]);
    }
}
