<?php

namespace Database\Seeders\v1;

use App\Models\v1\RangeCost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RangeCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RangeCost::create([
            'range_type_id' => 1,
            'value' => 100000,
        ]);
        RangeCost::create([
            'range_type_id' => 2,
            'value' => 200000,
        ]);
        RangeCost::create([
            'range_type_id' => 3,
            'value' => 300000,
        ]);
        RangeCost::create([
            'range_type_id' => 4,
            'value' => 400000,
        ]);
        RangeCost::create([
            'range_type_id' => 5,
            'value' => 500000,
        ]);
    }
}
