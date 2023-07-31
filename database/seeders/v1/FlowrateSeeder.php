<?php

namespace Database\Seeders\v1;

use App\Models\v1\Flowrate;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlowrateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list = [];
        for ($i = 1; $i <= 1200; $i++) {
            $randpattern = '';
            while (strlen($randpattern) < fake()->numberBetween($min = 0, $max = 14))
                $randpattern .= rand(0, 1);

            $list[] = [
                'mag_date' => Carbon::now()->subDay()->addMinutes(-1 * $i)->format('Y-m-d H:i'),
                'mag_date_time' => Carbon::now()->subDay()->addMinutes(-1 * $i)->timestamp,
                'flowrate' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 50),
                'unit_flowrate' => 'm3/h',
                'totalizer_1' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                'totalizer_2' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                'totalizer_3' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                'unittotalizer' => 'm3',
                'analog_1' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 5),
                'analog_2' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 5),
                'status_battery' => fake()->numberBetween($min = 10, $max = 100),
                'alarm' => fake()->numberBetween($min = 10, $max = 150),
                'bin_alarm' => $randpattern,
                // 'file_name' => 'FILE-' . fake()->numberBetween($min = 1, $max = 5),
                'file_name' => 'FILE-1',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        $chunks = array_chunk($list, 500);
        foreach ($chunks as $chunk) {
            Flowrate::insert($chunk);
        }
    }
}
