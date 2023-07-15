<?php

namespace Database\Seeders\v1;

use App\Models\v1\MobileStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MobileStatusSeeder extends Seeder
{
    // use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MobileStatus::updateOrCreate([
            'name' => 'active',
            'slug' => 'active'
        ]);
        MobileStatus::updateOrCreate([
            'name' => 'inactive',
            'slug' => 'inactive'
        ]);
        MobileStatus::updateOrCreate([
            'name' => 'maintenance',
            'slug' => 'maintenance'
        ]);
    }
}
