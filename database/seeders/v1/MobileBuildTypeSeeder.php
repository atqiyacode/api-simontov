<?php

namespace Database\Seeders\v1;

use App\Models\v1\MobileBuildType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MobileBuildTypeSeeder extends Seeder
{
    // use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MobileBuildType::updateOrCreate([
            'name' => 'debug',
            'slug' => 'debug'
        ]);
        MobileBuildType::updateOrCreate([
            'name' => 'release',
            'slug' => 'release'
        ]);
        MobileBuildType::updateOrCreate([
            'name' => 'beta',
            'slug' => 'beta'
        ]);
    }
}
