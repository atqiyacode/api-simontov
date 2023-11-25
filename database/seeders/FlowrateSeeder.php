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
        for ($i = 1; $i <= 1000; $i++) {
            $randpattern = '';
            while (strlen($randpattern) < fake()->numberBetween($min = 0, $max = 14))
                $randpattern .= rand(0, 1);

            $locationId = 1;
            // $locationId = Location::pluck('id')->random();

            $list[] = [
                'created_at' => Carbon::now()->subDay()->addMinutes(-1 * $i)->format('Y-m-d H:i'),
                'mag_date' => Carbon::now()->subDay()->addMinutes(-1 * $i)->format('Y-m-d H:i'),
                // 'mag_date_time' => Carbon::now()->subDay()->addMinutes(-1 * $i)->timestamp,
                'flowrate' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
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
                'file_name' => 'MEDAN',

                'location_id' => $locationId,

                'ph' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 6, $max = 8),
                'cod' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10),
                'cond' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                'level' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                'do' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),

                'do_alarm_hi' => fake()->boolean(),
                'do_alarm_lo' => fake()->boolean(),
                'pres_alarm_hi' => fake()->boolean(),
                'pres_alarm_lo' => fake()->boolean(),
                'ph_alarm_hi' => fake()->boolean(),
                'ph_alarm_lo' => fake()->boolean(),

                'fm_status' => $randpattern,
                'fm_err_code' => $randpattern,

                'pln_stat' => fake()->boolean(),
                'panel_stat' => fake()->boolean(),

                'location_id' => $locationId,
            ];
        }
        $chunks = array_chunk($list, 500);
        foreach ($chunks as $chunk) {
            Flowrate::insert($chunk);
        }
    }
}
