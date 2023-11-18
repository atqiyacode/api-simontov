<?php

namespace Database\Seeders;

use App\Models\DashboardChart;
use Illuminate\Database\Seeder;

class DashboardChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $lists = [
            ['code' => 'realtime-flowrate-pressure', 'name' => 'REALTIME - Flowrate Pressure', 'status' => true],
            ['code' => 'realtime-cod', 'name' => 'REALTIME - COD', 'status' => true],
            ['code' => 'realtime-ph', 'name' => 'REALTIME - PH', 'status' => true],
            ['code' => 'realtime-cond', 'name' => 'REALTIME - COND', 'status' => true],
            ['code' => 'realtime-level', 'name' => 'REALTIME - LEVEL', 'status' => true],
            ['code' => 'radial-flowrate', 'name' => 'RADIAL - Flowrate', 'status' => true],
            ['code' => 'radial-pressure', 'name' => 'RADIAL - Pressure', 'status' => true],
            ['code' => 'radial-cod', 'name' => 'RADIAL - COD', 'status' => true],
            ['code' => 'radial-ph', 'name' => 'RADIAL - PH', 'status' => true],
            ['code' => 'radial-cond', 'name' => 'RADIAL - COND', 'status' => true],
            ['code' => 'radial-level', 'name' => 'RADIAL - LEVEL', 'status' => true],
        ];
        DashboardChart::insert($lists);
    }
}
