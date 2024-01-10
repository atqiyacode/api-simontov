<?php

namespace Database\Seeders;

use App\Models\RangeType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RangeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
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
            'slug' => Str::slug('sample 3'),
            'label' => 'sample 3',
            'lower_limit' => 250,
            'upper_limit' => 500,
        ]);
        RangeType::create([
            'slug' => Str::slug('sample 4'),
            'label' => 'sample 4',
            'lower_limit' => 500,
            'upper_limit' => 1000,
        ]);
        RangeType::create([
            'slug' => Str::slug('sample 5'),
            'label' => 'sample 5',
            'lower_limit' => 1000,
            'upper_limit' => 2000,
        ]);
    }
}
