<?php

namespace Database\Seeders;

use App\Models\RangeCost;
use Illuminate\Database\Seeder;

class RangeCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
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
