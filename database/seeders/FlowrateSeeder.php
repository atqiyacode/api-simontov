<?php

namespace Database\Seeders;

use App\Models\Flowrate;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FlowrateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $list = [];
        for ($i = 1; $i <= 100; $i++) {
            $randpattern = '';
            while (strlen($randpattern) < fake()->numberBetween($min = 0, $max = 14))
                $randpattern .= rand(0, 1);

            $locationId = Location::pluck('id')->random();

            $list[] = [
                'mag_date' => Carbon::now()->subDay()->addMinutes(-1 * $i)->format('Y-m-d H:i'),
                // 'mag_date_time' => Carbon::now()->subDay()->addMinutes(-1 * $i)->timestamp,
                'flowrate' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 50),
                'unit_flowrate' => 'm3/h',
                'totalizer_1' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                'totalizer_2' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                'totalizer_3' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                'unit_totalizer' => 'm3',
                'analog_1' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 5),
                'pressure' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 5),
                'status_battery' => fake()->numberBetween($min = 10, $max = 100),
                'alarm' => fake()->numberBetween($min = 10, $max = 150),
                'bin_alarm' => $randpattern,
                // 'file_name' => 'FILE-' . fake()->numberBetween($min = 1, $max = 5),
                'file_name' => 'FILE-1',
                'created_at' => now(),
                'updated_at' => now(),

                'ph' => fake()->numberBetween($min = 1, $max = 10),
                'cod' => fake()->numberBetween($min = 1, $max = 10),
                'cond' => fake()->numberBetween($min = 1, $max = 100),
                'level' => fake()->numberBetween($min = 1, $max = 100),

                'location_id' => $locationId,
            ];
        }
        $chunks = array_chunk($list, 500);
        foreach ($chunks as $chunk) {
            Flowrate::insert($chunk);
        }
    }
}
