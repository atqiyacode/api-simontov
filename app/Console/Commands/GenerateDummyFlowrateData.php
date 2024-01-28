<?php

namespace App\Console\Commands;

use App\Jobs\FlowrateMqttJob;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateDummyFlowrateData extends Command
{
    protected $signature = 'generate:dummy-data';
    protected $description = 'Generate and dispatch dummy data with a 5-second delay between batches';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // $count = $this->argument('count');
        $count = 18000;
        $batchSize = 1; // Adjust the batch size as needed

        for ($i = 0; $i < $count; $i += $batchSize) {
            $batchCount = min($batchSize, $count - $i);

            for ($j = 0; $j < $batchCount; $j++) {
                $randpattern = '';
                while (strlen($randpattern) < fake()->numberBetween($min = 0, $max = 14))
                    $randpattern .= rand(0, 1);

                // $locationId = 1;
                $locationId = Location::pluck('id')->random();
                // Generate dummy data and dispatch it as a job with a 5-second delay
                dispatch(new FlowrateMqttJob([
                    'mag_date' => now(),
                    // 'mag_date' => now()->addHours(-12),
                    'flowrate' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                    'unit_flowrate' => 'm3/h',
                    'totalizer_1' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                    // 'totalizer_1' => 90,
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

                    'loc_id' => $locationId,

                    'ph' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 1, $max = 12),
                    'cod' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 85, $max = 95),
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
                ]));
            }

            // Output a message (optional)
            $this->info("Dispatched $batchCount - $locationId dummy data sets.");

            // Sleep for 5 seconds
            sleep(1);
        }
    }
}
