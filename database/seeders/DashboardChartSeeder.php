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
        DashboardChart::factory(10)->create();
    }
}
