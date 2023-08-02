<?php

namespace Database\Seeders\v1;

use App\Models\v1\RangeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RangeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RangeType::create([
            'slug' => Str::slug('sample 1'),
            'label' => 'sample 1',
            'lower_limit' => 10,
            'upper_limit' => 100,
        ]);
        RangeType::create([
            'slug' => Str::slug('sample 2'),
            'label' => 'sample 2',
            'lower_limit' => 100,
            'upper_limit' => 250,
        ]);
        RangeType::create([
            'slug' => Str::slug('sample 2'),
            'label' => 'sample 2',
            'lower_limit' => 250,
            'upper_limit' => 500,
        ]);
        RangeType::create([
            'slug' => Str::slug('sample 2'),
            'label' => 'sample 2',
            'lower_limit' => 500,
            'upper_limit' => 1000,
        ]);
    }
}
