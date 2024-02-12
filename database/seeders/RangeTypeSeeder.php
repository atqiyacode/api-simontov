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
            'slug' => Str::slug('Range Flat'),
            'label' => 'Range Flat',
            'lower_limit' => 0,
            'upper_limit' => 50,
        ]);
        RangeType::create([
            'slug' => Str::slug('Range Cost'),
            'label' => 'Range Cost',
            'lower_limit' => 51,
            'upper_limit' => 10000000000,
        ]);
    }
}
