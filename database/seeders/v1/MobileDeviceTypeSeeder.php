<?php

namespace Database\Seeders\v1;

use App\Models\v1\MobileDeviceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MobileDeviceTypeSeeder extends Seeder
{
    // use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MobileDeviceType::updateOrCreate([
            'name' => 'android',
            'slug' => 'android'
        ]);
        MobileDeviceType::updateOrCreate([
            'name' => 'ios',
            'slug' => 'ios'
        ]);
    }
}
