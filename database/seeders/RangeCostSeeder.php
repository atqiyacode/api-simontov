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
            'value' => 400000,
        ]);
        RangeCost::create([
            'range_type_id' => 2,
            'value' => 8000,
        ]);
    }
}
